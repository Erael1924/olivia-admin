<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class TicketsController extends Controller
{
    /**
     * Display the suport tickets view.
     */
    public function view(): Response
    {
        return Inertia::render('HelpCenter/SupportTickets/IndexView', [
            'status' => session('status'),
        ]);
    }

    /**
     * Display the ticket information view.
     */
    public function ticketInformation(): Response
    {
        return Inertia::render('HelpCenter/SupportTickets/TicketView', [
            'status' => session('status'),
        ]);
    }

}
