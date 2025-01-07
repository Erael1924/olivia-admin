<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AccountSettingController extends Controller
{
    public function view(): Response
    {
        return Inertia::render('AccountSettings/IndexView', [
            'status' => session('status'),
        ]);
    }
}
