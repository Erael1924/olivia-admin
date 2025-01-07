<?php

namespace App\Models\Traits;

trait StatusConstants
{
    public const DRAFT = '1';
    public const PENDING = '2';
    public const PUBLISHED = '3';
    public const UNPUBLISHED = '4';
    public const ACTIVE = '5';
    public const INACTIVE = '6';
    public const DEACTIVATED = '7';
    public const ONGOING = '8';
    public const EXPIRED = '9';
    public const ONHOLD = '10';
    public const CLOSED = '11';

    public static function getStatusName($statusCode)
    {
        $statusMap = [
            self::DRAFT => 'Draft',
            self::PENDING => 'Pending',
            self::PUBLISHED => 'Published',
            self::UNPUBLISHED => 'Unpublished',
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::DEACTIVATED => 'Deactivated',
            self::ONGOING => 'Ongoing',
            self::EXPIRED => 'Expired',
            self::ONHOLD => 'On Hold',
            self::CLOSED => 'Closed',
        ];

        return $statusMap[$statusCode] ?? 'Unknown'; // Return 'Unknown' if the status is not found
    }
}
