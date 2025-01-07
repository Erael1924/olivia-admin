<?php

namespace App\Models\Traits;

trait OrderStatusConstants
{
    public const PENDING = '1';
    public const PREPARING = '2';
    public const TO_SHIP = '3';
    public const SHIPPED = '4';
    public const INTRANSIT = '5';
    public const DELIVERED = '6';
    public const CANCELLED = '7';
    public const RETURN_PENDING = '8';
    public const RETURN_APPROVED = '9';
    public const RETURN_DECLINED = '10';
    public const RETURN_COMPLETED = '11';
    public const RETURN_CANCELLED = '12';
}
