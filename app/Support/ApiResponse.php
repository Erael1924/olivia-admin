<?php

namespace App\Support;

class ApiResponse
{
    public const SUCCESS = [
        'code' => 0,
        'message' => 'api.success',
    ];

    public const AUTHORIZATION_FAILED = [
        'code' => 1,
        'message' => 'api.access_denied',
    ];

    public const AUTHENTICATION_FAILED = [
        'code' => 2,
        'message' => 'api.failed.login',
    ];

    public const INVALID_RESET_TOKEN = [
        'code' => 3,
        'message' => 'api.invalid.token.reset',
    ];

    public const VALIDATION_ERROR = [
        'code' => 4,
        'message' => 'api.failed.validation',
    ];

    public const TROTTLED_REQUEST = [
        'code' => 5,
        'message' => 'api.trottled',
    ];

    public const INVALID_DOWNLOAD_LINK = [
        'code' => 6,
        'message' => 'api.invalid.download_link',
    ];

    public const ROLE_IN_USE = [
        'code' => 7,
        'message' => 'api.role_delete_failed',
    ];


    public const EXPIRED_AUTH_TOKEN = [
        'code' => 9,
        'message' => 'api.invalid.token.auth',
    ];

    public const FAILED_DELETION = [
        'code' => 10,
        'message' => 'api.failed.delete',
    ];

    public const ACCOUNT_DISABLED = [
        'code' => 12,
        'message' => 'api.account_disabled',
    ];

    public const PAGE_NOT_FOUND = [
        'code' => 404,
        'message' => 'api.page_not_found',
    ];

    public const INTERNAL_ERROR = [
        'code' => 9999,
        'message' => 'api.internal_error',
    ];

    public const USER_NOT_FOUND = [
        'code' => 404,
        'message' => 'api.invalid.user',
    ];

    public const INVALID_PASSWORD = [
        'code' => 13,
        'message' => 'api.invalid.password',
    ];
}
