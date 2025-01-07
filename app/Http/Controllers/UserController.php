<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct(
        private BaseRepositoryInterface $baseRepository,
    ) {
    }

    /**
     * Display the user page view.
     */
    public function view(Request $request)
    {
        $queryParams = $request->query();

        $filters = [];
        if(isset($request->username)){
            $filters['username'] = [
                'operator' => 'like',
                'value' => $request->username
            ];
        }

        if(isset($request->full_name)){
            $filters['full_name'] = [
                'operator' => 'like',
                'value' => $request->full_name
            ];
        }

        if(isset($request->email_address)){
            $filters['email_address'] = [
                'operator' => 'like',
                'value' => $request->email_address
            ];
        }

        if(isset($request->role)){
            $filters['role_id'] = [
                'operator' => 'equal',
                'value' => $request->role
            ];
        }

        if(isset($request->status)){
            $filters['status'] = [
                'operator' => 'equal',
                'value' => self::STATUS[$request->status]
            ];
        }

        $orderBy = is_array($request->order_by) ? $request->order_by : [];

        $data = $this->baseRepository->search(\App\Models\User::class, $filters, ['*'], ['role'], [], $orderBy);

        return Inertia::render('Users/IndexView', [
            'status' => session('status'),
            'result' => UserResource::collection($data),
            'roles' => $this->roles(),
            'query' => $queryParams,
            'user' => session('user'),
        ]);
    }

    public function roles(){
        // Retrieve active roles
        $filter = [
            'status' => [
                'operator' => 'equal',
                'value' => self::STATUS['active']
            ]
        ];

        return $this->baseRepository->search(\App\Models\Roles::class, $filter, ['id', 'role_name','slug'], [], [], [], true);
    }

    public function create(UserCreateRequest $request)
    {

        $data = $request->validated();

        $data['role_id'] = $data['role'];
        unset($data['role']);
        $password = Str::random(16);
        $data['password'] = $password;

        $user = $this->baseRepository->create(\App\Models\User::class, $data);
        $user->password = $password;

        return Redirect::route('users')->with(['user' => $data]);
    }

    public function update(UserUpdateRequest $request, User $id)
    {
        $data = $request->validated();

        $data['role_id'] = $data['role'];
        unset($data['role']);

        $data['status'] = self::STATUS[$request->status];
        $id->update($data);

        return Redirect::route('users');
    }

    public function resetPassword(User $id)
    {

        $password = Str::random(16);
        $data['password'] = $password;

        $id->update($data);

        return Redirect::route('users')->with(['user' => $data]);
    }
}
