<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\PaymentFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStorePaymentRequest;
use App\Http\Requests\V1\StorePaymentRequest;
use App\Http\Requests\V1\UpdatePaymentRequest;
use App\Http\Resources\V1\PaymentCollection;
use App\Http\Resources\V1\PaymentResource;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    public function bulkStore(BulkStorePaymentRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr, $key) {
            return Arr::except($arr, ['paymentId', 'payerId', 'payerEmail', 'paymentMethod', 'paymentStatus']);
        });

        $now = Carbon::now();
        $bulk = $bulk->map(function ($record) use ($now) {
            $record['created_at'] = $now;
            $record['updated_at'] = $now;
            return $record;
        });

        Payment::insert($bulk->toArray());
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());
    }
}
