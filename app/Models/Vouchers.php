<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'voucher_code',
        'description',
        'voucher_type',
        'amount',
        'minimum_spend',
        'capped',
        'usage_limit',
        'maximum_redemptions',
        'start_date',
        'end_date',
        'status',
        'applies_to'
    ];
}
