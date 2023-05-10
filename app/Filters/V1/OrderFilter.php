<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class OrderFilter extends ApiFilter {
    protected $safeParams = [
        'buyerId' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'totalAmount' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'status' => ['eq', 'ne'],
    ];

    protected $colMap = [
        'buyerId' => 'buyer_id',
        'totalAmount' => 'total_amount',
    ];
}