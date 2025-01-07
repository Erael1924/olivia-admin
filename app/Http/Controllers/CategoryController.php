<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Resources\CategoryResource;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Models\{
    Categories,
    Collections
};
use App\Http\Requests\Products\CategoryCreateRequest;
use App\Http\Requests\Products\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function __construct(
        private BaseRepositoryInterface $baseRepository,
    ) {
    }

    /**
     * Display the category page view.
     */
    public function view(Request $request): Response
    {
        $queryParams = $request->query();

        $filters = [];
        if(isset($request->category_name)){
            $filters['name'] = [
                'operator' => 'like',
                'value' => $request->category_name
            ];
        }

        if(isset($request->collection)){
            $filters['collection'] = [
                'raw' => true,
                'operator' => 'greater',
                'value' => '0',
                'query' => '(SELECT COUNT(*) FROM category_collection_types WHERE category_collection_types.category_id = categories.id AND category_collection_types.collection_id = ' . $request->collection. ')'
            ];
        }

        if(isset($request->status)){
            $filters['status'] = [
                'operator' => 'equal',
                'value' => self::STATUS[$request->status]
            ];
        }

        $orderBy = is_array($request->order_by) ? $request->order_by : [];

        $data = $this->baseRepository->search(\App\Models\Categories::class, $filters, ['*'], ['collectionType'], [], $orderBy);

        return Inertia::render('Category/IndexView', [
            'status' => session('status'),
            'result' => CategoryResource::collection($data),
            'collection' => $this->collection(),
            'query' => $queryParams,
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

        return $this->baseRepository->search(\App\Models\Collections::class, $filter, ['id', 'name','slug'], [], [], [], true);
    }

    public function create(CategoryCreateRequest $request)
    {
        $collection = $request->collection;
        $data = [
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'status' => self::STATUS[$request->status]
        ];

        $category = $this->baseRepository->create(\App\Models\Categories::class, $data);

        foreach ($collection as $collection) {
            $this->baseRepository->create(\App\Models\CategoryCollectionTypes::class, ['category_id' => $category->id, 'collection_id' => $collection]);
        }

        return Redirect::route('products.category');
    }

    public function update(CategoryUpdateRequest $request, Categories $id)
    {
        $collection = $request->collection;
        $data = [
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'status' => self::STATUS[$request->status]
        ];

        $id->update($data);

        $id->collectionType()->detach();

        foreach ($collection as $collection) {
            $this->baseRepository->create(\App\Models\CategoryCollectionTypes::class, ['category_id' => $id->id, 'collection_id' => $collection]);
        }

        return Redirect::route('products.category');
    }
}
