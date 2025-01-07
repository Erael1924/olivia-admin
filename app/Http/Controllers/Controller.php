<?php

namespace App\Http\Controllers;


abstract class Controller
{
    public const STATUS = [
        'draft' => '1',
        'pending' => '2',
        'published' => '3',
        'unpublished' => '4',
        'active' => '5',
        'inactive' => '6',
        'deactivated' => '7',
        'ongoing' => '8',
        'expired' => '9',
        'onhold' => '10',
        'closed' => '11'
    ];
}
