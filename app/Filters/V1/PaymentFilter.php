<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class PaymentFilter extends ApiFilter {
    protected $safeParams = [
        'paymentId' => ['eq', 'ne'],
        'payerId' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'payerEmail' => ['eq', 'ne'],
        'amount' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'currency' => ['eq', 'ne'],
        'paymentMethod' => ['eq', 'ne'],
        'paymentStatus' => ['eq', 'ne'],
    ];

    protected $colMap = [
        'paymentId' => 'payment_id',
        'payerId' => 'payer_id',
        'payerEmail' => 'payer_email',
        'paymentMethod' => 'payment_method',
        'paymentStatus' => 'payment_status',
    ];
}