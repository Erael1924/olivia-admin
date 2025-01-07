<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Products\ProductCreateRequest;
use App\Support\StoreImage;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductInfoResource;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Categories,
    Collections,
    SubCategories,
    Products,
    ProductDetails,
    ProductVariants,
    ProductImages,
    ProductVariantImages,
    Tags,
    Variants
};

class ProductController extends Controller
{
    public function __construct(
        private BaseRepositoryInterface $baseRepository,
        private ProductRepositoryInterface $productRepository,
    ) {
    }

    /**
     * Display the product view.
     */
    public function view(Request $request): Response
    {
        $queryParams = $request->query();

        $filters = [];
        if(isset($request->product_name)){
            $filters['name'] = [
                'operator' => 'like',
                'value' => $request->product_name
            ];
        }

        if(isset($request->product_code)){
            $filters['product_code'] = [
                'operator' => 'like',
                'value' => $request->product_code
            ];
        }

        if(isset($request->status)){
            $filters['status'] = [
                'operator' => 'equal',
                'value' => self::STATUS[$request->status]
            ];
        }

        if(isset($request->collection)){
            $filters['collection_id'] = [
                'operator' => 'equal',
                'value' => $request->collection
            ];
        }

        if(isset($request->category)){
            $filters['category_id'] = [
                'operator' => 'equal',
                'value' => $request->category
            ];
        }

        if(isset($request->sub_category)){
            $filters['sub_category_id'] = [
                'operator' => 'equal',
                'value' => $request->sub_category
            ];
        }

        $stockFilter = isset($request->stock_status) ? $request->stock_status : "";
        $orderBy = is_array($request->order_by) ? $request->order_by : [];

        $data = $this->productRepository->search($filters, $stockFilter, $orderBy);

        return Inertia::render('Products/IndexView', [
            'status' => session('status'),
            'result' => ProductResource::collection($data),
            'collections' => $this->collection(),
            'categories' => $this->categories(),
            'sub_categories' => $this->subCategories(),
            'query' => $queryParams,
        ]);
    }

    public function viewProduct(Products $id): Response
    {
        $id->load(['collection', 'category', 'subCategory', 'details', 'images', 'variants' => function ($query){
            $query->select('product_id',
                DB::raw('SUM(stock) as total_stock'),
                DB::raw('SUM(sold) as total_sold'),
                DB::raw('MIN(price) as min_price'),
                DB::raw('MAX(price) as max_price'));
            }
        ]);

        $product = new ProductInfoResource($id);
        $filters['product_id'] = [
            'operator' => 'equal',
            'value' => $product->id
        ];
        $variants = $this->baseRepository->search(Variants::class, $filters, ['*'], [], [], [], true);

        $options = $this->baseRepository->search(ProductVariants::class, $filters, ['*'], ['images'], [], [], true);

        return Inertia::render('Products/ViewProduct', [
            'status' => session('status'),
            'result' => $product,
            'variants' => $variants,
            'options' => $options
        ]);
    }

    public function viewCreateProduct(): Response
    {
        return Inertia::render('Products/CreateProduct', [
            'status' => session('status'),
            'collections' => $this->collection(),
            'categories' => $this->categories(),
            'sub_categories' => $this->subCategories(),
            'tags' => $this->tags(),
        ]);
    }

    public function viewUpdateProduct(Products $id): Response
    {
        $id->load(['collection', 'category', 'subCategory', 'details', 'images']);

        $product = new ProductInfoResource($id);
        $filters['product_id'] = [
            'operator' => 'equal',
            'value' => $product->id
        ];
        $variants = $this->baseRepository->search(Variants::class, $filters, ['*'], [], [], [], true);

        $options = $this->baseRepository->search(ProductVariants::class, $filters, ['*'], ['images'], [], [], true);

        return Inertia::render('Products/UpdateProduct', [
            'status' => session('status'),
            'result' => $product,
            'variants' => $variants,
            'options' => $options,
            'collections' => $this->collection(),
            'categories' => $this->categories(),
            'sub_categories' => $this->subCategories(),
            'tags' => $this->tags(),
        ]);
    }

    public function collection(){
        // Retrieve active collection
        $filter = [
            'status' => [
                'operator' => 'equal',
                'value' => self::STATUS['active']
            ]
        ];

        return $this->baseRepository->search(Collections::class, $filter, ['id', 'name','slug'], [], [], [], true);
    }

    public function categories(){
        // Retrieve active categories
        $filter = [
            'status' => [
                'operator' => 'equal',
                'value' => self::STATUS['active']
            ]
        ];

        return $this->baseRepository->search(Categories::class, $filter, ['id', 'name','slug'], [], [], [], true);
    }

    public function subCategories(){
        // Retrieve active sub categories
        $filter = [
            'status' => [
                'operator' => 'equal',
                'value' => self::STATUS['active']
            ]
        ];

        return $this->baseRepository->search(SubCategories::class, $filter, ['id', 'name','slug'], [], [], [], true);
    }

    public function tags(){
        return $this->baseRepository->search(Tags::class, [], ['id', 'name'], [], [], [], true);
    }

    public function create(ProductCreateRequest $request)
    {
        if($request->form == 1 || ($request->form == 2 && $request->has_variant == 1)){
            return Redirect::route('products.create');
        }

        $data = [
            'name' => $request->product_name,
            'description' => $request->description,
            'collection_id' => $request->collection,
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'tags' => $request->tags ? implode(",", $request->tags) : null,
            'weight' => $request->weight,
            'width' => $request->width,
            'length' => $request->length,
            'height' => $request->height,
            'has_variant' => $request->has_variant,
        ];

        if($request->has_variant == 0){
            $data['price'] = $request->price;
            $data['stock'] = $request->stock;
        }

        $storeImage = new StoreImage();

        // Call the storeImage method
        $result = $storeImage->storeImage($request->thumbnail,'products');
        if($result['error']){

        }else{
            $data['thumbnail'] = $result['url'];
        }

        $product = $this->baseRepository->create(Products::class, $data);

        if(isset($request->product_details) && count($request->product_details) > 0){
            $items = $request->product_details;
            foreach ($items as $item) {
                $item['product_id'] = $product->id;
                $this->baseRepository->create(ProductDetails::class, $item);
            }
        }

        if(isset($request->product_images) && count($request->product_images) > 0 &&  $request->has_variant == 0){
            $images = $request->product_images;
            foreach ($images as $key => $image) {
                $result = $storeImage->storeImage($image,'products');
                if($result['error']){

                }else{
                    $imageData = [
                        'product_id' => $product->id,
                        'image_url' => $result['url']
                    ];
                    $this->baseRepository->create(ProductImages::class, $imageData);
                }
            }
        }

        if(isset($request->variants) && count($request->variants) > 0 &&  $request->has_variant == 1){
            $variants = $request->variants;
            if(count($variants) == 2){
                $variant = $request->variants[0];
                $secondVariant = $request->variants[1];
                $secondVariantOptions = $request->variants[1]['options'];
                $variantInfo = $request->variants_info;

                $variantName = $variant['name'];
                $options = $variant['options'];

                $newVariant = [
                    'product_id' => $product->id,
                    'name' => $variant['name'],
                    'level' => 1,
                    'status' => 1
                ];

                $this->baseRepository->create(Variants::class, $newVariant);

                $newVariant['name'] = $secondVariant['name'];
                $newVariant['level'] = 2;
                $this->baseRepository->create(Variants::class, $newVariant);


                foreach ($options as $key => $option) {
                    $optionID = null;
                    $level = $key + 1;
                    $images = $option['images'];
                    $newOption = [
                        'product_id' => $product->id,
                        'first_option' => $option['name'],
                        'status' => 1,
                        'level' => $level
                    ];

                    foreach ($secondVariantOptions as $index => $secondVariantOption) {
                        $newOption['sku'] = $this->generateSKU($product->id, $request->product_name, $option['name'], $secondVariantOption['name']);
                        $newOption['second_option'] = $secondVariantOption['name'];
                        $newOption['stock'] = $variantInfo[$key][$index]['stock'];
                        $newOption['price'] = $variantInfo[$key][$index]['price'];
                        $save = $this->baseRepository->create(ProductVariants::class, $newOption);
                        if($index == 0){
                            $optionID = $save->id;
                        }
                    }

                    foreach ($images as $key => $image) {
                        // Call the storeImage method
                        $result = $storeImage->storeImage($image,'products');
                        if($result['error']){

                        }else{
                            $optionImageData = [
                                'product_variant_id' => $optionID,
                                'image_url' => $result['url']
                            ];
                            $this->baseRepository->create(ProductVariantImages::class, $optionImageData);
                        }
                    }

                }
            }

        }

        return Redirect::route('products');
    }

    public function update(ProductCreateRequest $request, Products $id)
    {
        $currentHasVariant = $id->has_variant;
        if($request->form == 1 || ($request->form == 2 && $request->has_variant == 1)){
            return Redirect::route('products.update', [ 'id' => $id->id]);
        }

        $data = [
            'name' => $request->product_name,
            'description' => $request->description,
            'collection_id' => $request->collection,
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'tags' => $request->tags ? implode(",", $request->tags) : null,
            'weight' => $request->weight,
            'width' => $request->width,
            'length' => $request->length,
            'height' => $request->height,
            'has_variant' => $request->has_variant,
        ];

        if($request->has_variant == 0){
            $data['price'] = $request->price;
            $data['stock'] = $request->stock;
        }

        $storeImage = new StoreImage();

        if(is_array($request->thumbnail)){
            $result = $storeImage->storeImage($request->thumbnail,'products');
            if($result['error']){

            }else{
                $data['thumbnail'] = $result['url'];
            }
        }

        // Update product details
        $id->update($data);

        if ($request->filled('product_details')) {
            $id->details()->delete();

            $items = $request->product_details;
            foreach ($items as $item) {
                $item['product_id'] = $id->id;
                $this->baseRepository->create(ProductDetails::class, $item);
            }
        }

        if($request->filled('removed_product_images')){
            $this->baseRepository->deleteWhereIn(ProductImages::class, 'id', $request->removed_product_images);
        }

        if($request->filled('product_images') &&  $request->has_variant == 0){
            $images = $request->product_images;
            foreach ($images as $key => $image) {
                if(is_array($image)){
                    $result = $storeImage->storeImage($image,'products');
                    if($result['error']){

                    }else{
                        $imageData = [
                            'product_id' => $id->id,
                            'image_url' => $result['url']
                        ];
                        $this->baseRepository->create(ProductImages::class, $imageData);
                    }
                }
            }
        }

        // If the current product has variant and want to change to no variant product, will change status of the variants
        if($currentHasVariant != $request->has_variant){
            $this->baseRepository->update(ProductVariants::class, 'product_id', $id->id, ['status' => self::STATUS['inactive']]);
        }

        if($request->filled('removed_variants')){
            $removedVariants = $request->removed_variants;
            foreach ($removedVariants as $rv) {
                $this->productRepository->removeVariant($rv);
            }
        }

        if($request->filled('removed_variant_options')){
            $removedVariantOptions = $request->removed_variant_options;
            foreach ($removedVariantOptions as $rvo) {
                $this->productRepository->removeVariantOption($rvo['id'],$rvo['type']);
            }
        }

        if($request->filled('variants') &&  $request->has_variant == 1){
            $variants = $request->variants;
            if(count($variants) == 2){
                $variant = $request->variants[0];
                $secondVariant = $request->variants[1];
                $secondVariantOptions = $request->variants[1]['options'];
                $variantInfo = $request->variants_info;

                $variantName = $variant['name'];
                $options = $variant['options'];

                if(!isset($variant['id'])){
                    $newVariant = [
                        'product_id' => $id->id,
                        'name' => $variant['name'],
                        'level' => 1,
                        'status' => 1
                    ];
                    $this->baseRepository->create(Variants::class, $newVariant);
                }

                if(!isset($secondVariant['id'])){
                    $newVariant = [
                        'product_id' => $id->id,
                        'name' => $secondVariant['name'],
                        'level' => 2,
                        'status' => 1
                    ];
                    $this->baseRepository->create(Variants::class, $newVariant);
                }

                foreach ($options as $key => $option) {
                    $optionID = null;
                    $level = $key + 1;
                    $images = $option['images'];

                    $newOption = [
                        'product_id' => $id->id,
                        'first_option' => $option['name'],
                        'status' => 1,
                        'level' => $level
                    ];

                    foreach ($secondVariantOptions as $index => $secondVariantOption) {
                        $newOption['sku'] = $this->generateSKU($id->id, $request->product_name, $option['name'], $secondVariantOption['name']);
                        $newOption['second_option'] = $secondVariantOption['name'];
                        $newOption['stock'] = $variantInfo[$key][$index]['stock'];
                        $newOption['price'] = $variantInfo[$key][$index]['price'];
                        $currentOptionId = null;

                        if(isset($variantInfo[$key][$index]['id'])){
                            $save = $this->baseRepository->update(ProductVariants::class, 'id', $variantInfo[$key][$index]['id'], $newOption);
                            $currentOptionId = $variantInfo[$key][$index]['id'];
                        }else{
                            $save = $this->baseRepository->create(ProductVariants::class, $newOption);
                            $currentOptionId = $save->id;
                        }

                        if($index == 0){
                            $optionID = $currentOptionId;
                        }
                    }

                    foreach ($images as $key => $image) {
                        // Call the storeImage method
                        if(!isset($image['id'])){
                            $result = $storeImage->storeImage($image,'products');
                            if($result['error']){

                            }else{
                                $optionImageData = [
                                    'product_variant_id' => $optionID,
                                    'image_url' => $result['url']
                                ];
                                $this->baseRepository->create(ProductVariantImages::class, $optionImageData);
                            }
                        }else{
                            $optionImageData = [
                                'product_variant_id' => $optionID,
                                'image_url' => $image['image']
                            ];
                            \Illuminate\Support\Facades\Log::debug("optionImageData", $optionImageData);
                            $this->baseRepository->update(ProductVariantImages::class, 'id', $image['id'], $optionImageData);
                        }
                    }

                }
            }

        }

        return Redirect::route('products');
    }

    public function generateSKU($productId, $productName, $firstString = "", $secondString = "") {
        $sku = "PRDCT-{$productId}";
        // Abbreviate product name
        $abbreviation = substr(strtoupper(preg_replace('/\s+/', '', $productName)), 0, 2);
        $sku .= "{$abbreviation}";

        // Color abbreviation
        if($firstString){
            $firstCode = strtoupper(substr($firstString, 0, 2));
            $sku .= "-{$firstCode}";
        }

        // Size abbreviation
        if($secondString){
            $secondCode = strtoupper(substr($secondString, 0, 1));
            $sku .= "-{$secondCode}";
        }

        return $sku;
    }
}
