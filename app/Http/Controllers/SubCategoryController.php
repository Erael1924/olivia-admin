<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Resources\SubCategoryResource;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Models\{
    SubCategories,
    Collections,
    SubCategoriesTypes
};
use App\Http\Requests\Products\SubCategoryCreateRequest;
use App\Http\Requests\Products\SubCategoryUpdateRequest;

class SubCategoryController extends Controller
{
    public function __construct(
        private BaseRepositoryInterface $baseRepository,
    ) {
    }

    /**
     * Display the sub category page view.
     */
    public function view(Request $request): Response
    {
        $queryParams = $request->query();

        $filters = [];
        if(isset($request->sub_category_name)){
            $filters['name'] = [
                'operator' => 'like',
                'value' => $request->sub_category_name
            ];
        }

        if(isset($request->category)){
            $filters['category_id'] = [
                'operator' => 'equal',
                'value' => $request->category
            ];
        }

        if(isset($request->status)){
            $filters['status'] = [
                'operator' => 'equal',
                'value' => self::STATUS[$request->status]
            ];
        }

        $orderBy = is_array($request->order_by) ? $request->order_by : [];

        $data = $this->baseRepository->search(\App\Models\SubCategories::class, $filters, ['*'], ['category'], [], $orderBy);

        return Inertia::render('SubCategory/IndexView', [
            'status' => session('status'),
            'result' => SubCategoryResource::collection($data),
            'categories' => $this->categories(),
            'query' => $queryParams,
        ]);
    }

    public function categories(){
        // Retrieve active collection
        $filter = [
            'status' => [
                'operator' => 'equal',
                'value' => self::STATUS['active']
            ]
        ];

        return $this->baseRepository->search(\App\Models\Categories::class, $filter, ['id', 'name','slug'], [], [], [], true);
    }

    public function create(SubCategoryCreateRequest $request)
    {
        $data = [
            'name' => $request->sub_category_name,
            'slug' => Str::slug($request->sub_category_name),
            'category_id' => $request->category,
            'status' => self::STATUS[$request->status]
        ];

        $subcategory = $this->baseRepository->create(\App\Models\SubCategories::class, $data);

        return Redirect::route('products.sub-category');
    }

    public function update(SubCategoryUpdateRequest $request, SubCategories $id)
    {
        $data = [
            'name' => $request->sub_category_name,
            'slug' => Str::slug($request->sub_category_name),
            'category_id' => $request->category,
            'status' => self::STATUS[$request->status]
        ];

        $id->update($data);

        return Redirect::route('products.sub-category');
    }
}
