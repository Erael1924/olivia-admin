<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class FaqsController extends Controller
{
    /**
     * Display the faqs view.
     */
    public function view(): Response
    {
        return Inertia::render('HelpCenter/FAQS/IndexView', [
            'status' => session('status'),
        ]);
    }

    /**
     * Display the create faqs view.
     */
    public function createFaq(): Response
    {
        return Inertia::render('HelpCenter/FAQS/AddFaq', [
            'status' => session('status'),
        ]);
    }

     /**
     * Display the update faqs view.
     */
    public function updateFaq(): Response
    {
        return Inertia::render('HelpCenter/FAQS/EditFaq', [
            'status' => session('status'),
        ]);
    }

}
