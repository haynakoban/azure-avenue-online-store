<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\PaymentFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PaymentCollection;
use App\Http\Resources\V1\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $filter  = new PaymentFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new PaymentCollection(Payment::paginate());
        } else {
            return new PaymentCollection(Payment::where($queryItems)->paginate());
        }   
    }

    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }
}
