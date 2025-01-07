<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class CustomerInsightController extends Controller
{
    /**
     * Display the order page view.
     */
    public function view(): Response
    {
        return Inertia::render('Reports/CustomerInsights', [
            'status' => session('status'),
        ]);
    }
}
