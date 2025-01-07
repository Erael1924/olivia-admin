<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class BannersController extends Controller
{
    /**
     * Display the order page view.
     */
    public function view(): Response
    {
        return Inertia::render('ContentManagement/PromoBanners/IndexView', [
            'status' => session('status'),
        ]);
    }

    public function collectionBanners(): Response
    {
        return Inertia::render('ContentManagement/CollectionBanners/IndexView', [
            'status' => session('status'),
        ]);
    }
}
