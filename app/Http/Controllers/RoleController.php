<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Resources\RoleResource;
use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Roles;

class RoleController extends Controller
{
    public function __construct(
        private BaseRepositoryInterface $baseRepository,
        private PermissionRepositoryInterface $permissionRepository,
    ) {
    }

    /**
     * Display the role page view.
     */
    public function view(Request $request): Response
    {
        $queryParams = $request->query();

        $filters = [];
        if(isset($request->role_name)){
            $filters['role_name'] = [
                'operator' => 'like',
                'value' => $request->role_name
            ];
        }

        if(isset($request->status)){
            $filters['status'] = [
                'operator' => 'equal',
                'value' => self::STATUS[$request->status]
            ];
        }

        $orderBy = is_array($request->order_by) ? $request->order_by : [];

        $data = $this->baseRepository->search(\App\Models\Roles::class, $filters, ['*'], [], [], $orderBy);


        return Inertia::render('Role/IndexView', [
            'status' => session('status'),
            'result' => RoleResource::collection($data),
            'query' => $queryParams,
        ]);
    }

    public function create(RoleCreateRequest $request)
    {

        $data = $request->validated();
        $data['slug'] = Str::slug($request->role_name);

        $this->baseRepository->create(\App\Models\Roles::class, $data);

        return Redirect::route('roles');
    }

    public function update(RoleUpdateRequest $request, Roles $id)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['role_name']);
        $data['status'] = self::STATUS[$request->status];

        $id->update($data);

        return Redirect::route('roles');
    }

    public function permissions(Roles $role): Response
    {
        $role->load('permissions');
        $permissions = $role->permissions;

        $allPermissions = $this->permissionRepository->allGrouped();
        return Inertia::render('Role/Permission', [
            'status' => session('status'),
            'result' =>
                [
                    'allowed' => $permissions,
                    'permissions' => $allPermissions
                ],
            'role_id' => $role->id,
        ]);
    }

    /**
     * Update the specified resource in database.
     */
    public function updatePermissions(Request $request, Roles $role)
    {
        $role->permissions()->detach();

        $role->permissions()->sync($request->permissions);

        return Inertia::render('Role/Permission', [
            'status' => session('status'),
        ]);
    }

}
