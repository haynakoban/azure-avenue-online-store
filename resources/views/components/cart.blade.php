<form action="{{ route('checkout') }}" method="GET">
@csrf  
    <div class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping cart</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button x-on:click="cart = !cart" type="button" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <div class="flow-root">
                                        @unless ($shoppingBag->count() === 0)
                                            <div class="mb-4">
                                                <input type="checkbox" id="select-all">
                                                <label class="ml-3" for="select-all">Select All</label>
                                            </div>
                                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                                @foreach ($shoppingBag as $bag)
                                                    <li class="flex py-6">
                                                    <div class="flex items-center pr-3">
                                                        <input id="checkbox" class="item-checkbox" type="checkbox" name="item[]" value="{{ $bag->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                    </div>
                                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                        <img src="{{ $bag->product->image_url }}" alt="{{ $bag->product->name }}" class="h-full w-full object-cover object-center">
                                                    </div>
                                                    <div class="ml-4 flex flex-1 flex-col">
                                                        <div>
                                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                                <h3><a href="/products/{{ $bag->product->id }}">{{ $bag->product->name }}</a></h3>
                                                                <p class="ml-4" style="font-family: 'Poppins', 'Times New Roman'">$ {{ $bag->product->price }}</p>
                                                            </div>
                                                            <p class="mt-1 text-sm text-gray-500" 
                                                               style="overflow: hidden; 
                                                                    text-overflow: ellipsis; 
                                                                    display: -webkit-box;
                                                                    -webkit-box-orient: vertical;
                                                                    -webkit-line-clamp: 2; /* Number of lines to show */
                                                                    line-height: 20px; /* Adjust line height for spacing */
                                                                    max-height: 40px;"
                                                            >{{ $bag->product->description }}</p>
                                                        </div>
                                                        <div class="flex flex-1 items-end justify-between text-sm">
                                                            <p class="text-gray-500">Qty {{ $bag->quantity }}</p>
                                                            <div class="flex">
                                                                <button type="button" class="remove-item font-medium text-indigo-600 hover:text-indigo-500" data-url="{{ route('bags.destroy', $bag->id) }}">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        
                                        @else
                                        <p class="font-bold">Your bag is empty.</p>
                                        <p class="font-bold">Shop Now!</p>
                                        @endunless
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Subtotal</p>
                                    <p style="font-family: 'Poppins', 'Times New Roman'">$ {{ $totalAmount }}</p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                                <div class="mt-6">
                                    <button type="submit" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>