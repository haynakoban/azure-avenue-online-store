<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\PaymentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StorePaymentRequest;
use App\Http\Requests\V1\UpdatePaymentRequest;
use App\Http\Resources\V1\PaymentCollection;
use App\Http\Resources\V1\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $filter  = new PaymentFilter();
        $filterItems = $filter->transform($request);

        $payments = Payment::where($filterItems);

        $includeUser = $request->query('includeUser');

        if ($includeUser) {
            $payments = $payments->with('user');
        }

        return new PaymentCollection($payments->paginate()->appends($request->query()));  
    }

    public function show(Payment $payment)
    {
        $includeUser = request()->query('includeUser');

        if ($includeUser) {
            $payment = $payment->loadMissing('user');
        }

        return new PaymentResource($payment);
    }

    public function store(StorePaymentRequest $request)
    {
        return new PaymentResource(Payment::create($request->all()));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());
    }
}
