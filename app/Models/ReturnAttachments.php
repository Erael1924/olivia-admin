<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ReturnOrders;

class ReturnAttachments extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_order_id',
        'image_url'
    ];

    public function returnOrder(): BelongsTo
    {
        return $this->belongsTo(ReturnOrders::class, 'return_order_id');
    }
}
