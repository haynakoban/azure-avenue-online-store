@extends('layout.app')

@section('content')

<div>
    <div class="flex min-h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4">
        <div class="flex w-full transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl ">
            <div class="relative rounded-md flex w-full items-center overflow-hidden bg-white px-4 pb-8 pt-14 shadow-lg sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                <a href="{{ url()->previous() }}" class="absolute right-4 top-4 text-gray-400 hover:text-gray-500 sm:right-6 sm:top-8 md:right-6 md:top-6 lg:right-8 lg:top-8">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
                <div class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8">
                    <div class="aspect-h-3 aspect-w-2 overflow-hidden rounded-lg bg-gray-100 sm:col-span-4 lg:col-span-5">
                        <img src="{{ asset($product->image_url) }}" alt="Two each of gray, white, and black shirts arranged on table." class="object-cover object-center">
                    </div>
                    <div class="sm:col-span-8 lg:col-span-7">
                        <h2 class="text-2xl font-bold text-gray-900 sm:pr-12" style="max-height: 64px; overflow: hidden;">{{ $product->name }}</h2>
                        <section aria-labelledby="information-heading" class="mt-2">
                            <p class="text-2xl text-gray-900" style="font-family: 'Poppins', 'Times New Roman'">₱ {{ $product->price }}</p>
                            <!-- Reviews -->
                            <div class="mt-6">
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                        </svg>
                                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                        </svg>
                                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                        </svg>
                                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                        </svg>
                                        <svg class="text-gray-200 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <a href="#" class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">117 reviews</a>
                                </div>
                            </div>
                        </section>
                        <section aria-labelledby="options-heading" class="mt-7">
                            <form method="POST" action="{{ route('bags.store') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="flex items-center">
                                    <button type="button" class="minus-btn text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2">
                                        <svg class="h-4 w-4" fill="#333333" stroke="#333333" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15"></path>
                                        </svg>
                                    </button>
                                    <input type="number" name="quantity" min="1" max="50" value="1" class="quantity bg-white border border-gray-300 text-[#333333] w-[42px] h-[34px] rounded-lg text-center px-3 py-2 mr-2 mb-2 text-sm hover:bg-gray-100 focus:outline-none[appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <button type="button" class="plus-btn text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2">
                                        <svg class="h-4 w-4" fill="#333333" stroke="#333333" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                                        </svg>
                                    </button>
                                </div>
                                <button type="submit" class="mt-6 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add to bag</button>
                            </form>
                        </section>
                        @if ( !empty($product->description) )
                        <h2 class="mt-5 text-md font-semibold text-gray-900">Product Description:</h2>
                        <p class="mt-2 text-sm text-gray-900" style="max-height: 200px; overflow: hidden;">{{ $product->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection