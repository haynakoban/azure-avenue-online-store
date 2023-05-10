<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class CartFilter extends ApiFilter {
    protected $safeParams = [
        'userId' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'productId' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'quantity' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
    ];

    protected $colMap = [
        'userId' => 'user_id',
        'productId' => 'product_id',
    ];
}