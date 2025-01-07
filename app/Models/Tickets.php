<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tickets extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_number',
        'customer_id',
        'subject',
        'description',
        'category',
        'priority_level',
        'status',
        'assigned_to',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function support(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'assigned_to');
    }
}
