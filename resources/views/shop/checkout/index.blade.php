@extends('layout.app')

@section('content')

<main>
    <div class="mt-8 mx-auto max-w-xl py-6 px-4 sm:px-6 lg:px-8 border">
        @unless ($shoppingBag->count() === 0)
        <div class="mt-2">
            <div class="flow-root">
                <ul role="list" class="-my-6 divide-y divide-gray-200">
                    @foreach ($shoppingBag as $bag)
                        <li class="flex py-6">
                        <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                            <img src="{{ $bag->product->image_url }}" alt="{{ $bag->product->name }}" class="h-full w-full object-cover object-center">
                        </div>
                        <div class="ml-4 flex flex-1 flex-col">
                            <div>
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <h3><a href="/products/{{ $bag->product->id }}">{{ $bag->product->name }}</a></h3>
                                    <p class="ml-4" style="font-family: 'Poppins', 'Times New Roman'">$ {{ $bag->product->price }}</p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Salmon</p>
                            </div>
                            <div class="flex flex-1 items-end justify-between text-sm">
                                <p class="text-gray-500">Qty {{ $bag->quantity }}</p>
                                <div class="flex">
                                    <form method="POST" action="{{ route('bags.destroy', $bag->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>  
            </div>
        </div>

        <form action="{{ route('payment') }}" method="POST">
        @csrf
            <div class="mt-6 border-t border-gray-200 px-4 py-6 sm:px-6">
                <div class="flex justify-between text-base font-medium text-gray-900 pb-3">
                    <p>Subtotal</p>
                    <p style="font-family: 'Poppins', 'Times New Roman'">$ {{ $totalAmount }}</p>
                </div>
                <div class="flex justify-between text-base font-medium text-gray-900">
                    <p>Shipping</p>
                    <p style="font-family: 'Poppins', 'Times New Roman'">$ {{ number_format($shippingAmount, 2) }}</p>
                </div>
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                        <p class="font-bold">Total Amount</p>
                        <p style="font-family: 'Poppins', 'Times New Roman'">$ {{ $shippingAmount + $totalAmount }}</p>
                    </div>
                </div>
            </div>
        
            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                <p class="pb-3 font-bold">Payment</p>
                <div class="flex flex-start flex-col sm:flex-row text-base font-medium text-gray-900">
                    <input type="hidden" name="amount" value="{{ $shippingAmount + $totalAmount }}">

                    {{-- cart and product --}}
                    @foreach ($shoppingBag as $bag)
                        <input type="hidden" name="bag[]" value="{{ $bag }}">
                        <input type="hidden" name="product[]" value="{{ $bag->product }}">
                    @endforeach

                    <div class="flex items-center mr-6 mb-3 sm:mb-0">
                        <input id="default-radio-1" type="radio" value="cod" name="payment" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="default-radio-1" class="ml-2 text-sm font-semibold text-gray-900">Cash On Delivery</label>
                    </div>
                    <div class="flex items-center mr-6">
                        <input checked id="default-radio-2" type="radio" value="paypal" name="payment" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="default-radio-2" class="ml-2 text-sm font-semibold text-gray-900">PayPal</label>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 px-4 pt-6 sm:px-6">
                <div>
                    <button type="submit" class="w-full flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Place Order</button>
                </div>
            </div>
        </form>

        @else 
        <div class="text-center">
            <p class="font-bold">Your bag is empty.</p>
            <p class="font-bold">Shop Now!</p>
        </div>
        @endunless
    </div>
</main>

@endsection