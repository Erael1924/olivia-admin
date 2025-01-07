<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class EmailTemplateController extends Controller
{
    /**
     * Display the order page view.
     */
    public function view(): Response
    {
        return Inertia::render('ContentManagement/EmailTemplates/IndexView', [
            'status' => session('status'),
        ]);
    }

    public function createEmailTemplate(): Response
    {
        return Inertia::render('ContentManagement/EmailTemplates/AddEmailTemplate', [
            'status' => session('status'),
        ]);
    }

    public function editEmailTemplate(): Response
    {
        return Inertia::render('ContentManagement/EmailTemplates/EditEmailTemplate', [
            'status' => session('status'),
        ]);
    }
}
