<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PaymentCollection;
use App\Http\Resources\V1\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function index()
    {
        return new PaymentCollection(Payment::paginate());
    }

    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }
}
