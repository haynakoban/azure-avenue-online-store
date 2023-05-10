<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class ProductFilter extends ApiFilter {
    protected $safeParams = [
        'sellerId' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'categoryId' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'imageUrl' => ['eq', 'ne'],
        'name' => ['eq', 'ne'],
        'description' => ['eq', 'ne'],
        'price' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'quantity' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
    ];

    protected $colMap = [
        'sellerId' => 'seller_id',
        'categoryId' => 'category_id',
        'imageUrl' => 'image_url',
    ];
}