<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class PagesController extends Controller
{
    /**
     * Display the order page view.
     */
    public function view(): Response
    {
        return Inertia::render('ContentManagement/SitePages/IndexView', [
            'status' => session('status'),
        ]);
    }

    public function createSitePage(): Response
    {
        return Inertia::render('ContentManagement/SitePages/AddSitePage', [
            'status' => session('status'),
        ]);
    }

    public function editSitePage(): Response
    {
        return Inertia::render('ContentManagement/SitePages/EditSitePage', [
            'status' => session('status'),
        ]);
    }
}
