<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    /**
     * Display the order page view.
     */
    public function view(): Response
    {
        return Inertia::render('Orders/IndexView', [
            'status' => session('status'),
        ]);
    }

    /**
     * Display the order details view.
     */
    public function orderDetails(): Response
    {
        return Inertia::render('Orders/OrderDetails', [
            'status' => session('status'),
        ]);
    }

    /**
     * Display the return orders view.
     */
    public function returnOrders(): Response
    {
        return Inertia::render('Orders/ReturnOrders', [
            'status' => session('status'),
        ]);
    }
}
