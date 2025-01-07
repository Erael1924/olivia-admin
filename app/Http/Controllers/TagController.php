<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Resources\TagResource;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Models\{
    Tags
};
use App\Http\Requests\Products\{
    TagCreateRequest,
    TagUpdateRequest
};

class TagController extends Controller
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
        if(isset($request->tag_name)){
            $filters['name'] = [
                'operator' => 'like',
                'value' => $request->tag_name
            ];
        }

        $orderBy = is_array($request->order_by) ? $request->order_by : [];

        $data = $this->baseRepository->search(\App\Models\Tags::class, $filters, ['*'], [], [], $orderBy);

        return Inertia::render('Tag/IndexView', [
            'status' => session('status'),
            'result' => TagResource::collection($data),
            'query' => $queryParams,
        ]);
    }

    public function create(TagCreateRequest $request)
    {
        $data = [
            'name' => $request->tag_name
        ];

        $this->baseRepository->create(\App\Models\Tags::class, $data);

        return Redirect::route('products.tags');
    }

    public function update(TagUpdateRequest $request, Tags $id)
    {
        $data = [
            'name' => $request->tag_name
        ];

        $id->update($data);
        return Redirect::route('products.tags');
    }
}
