<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tickets;

class TicketAttachments extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_id',    // Add this line
        'image_url',    // Add this line
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }
}
