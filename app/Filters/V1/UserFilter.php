<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class UserFilter extends ApiFilter {
    protected $safeParams = [
        'roleType' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'name' => ['eq', 'ne'],
        'email' => ['eq', 'ne'],
        'provider' => ['eq', 'ne'],
        'providerId' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
    ];

    protected $colMap = [
        'roleType' => 'role_type',
        'providerId' => 'provider_id',
    ];
}