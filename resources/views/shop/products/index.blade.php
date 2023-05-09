@extends('layout.app')

@section('content')
    
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            
            <div class="mx-auto max-w-2xl lg:max-w-7xl bg-gray-50 rounded-md border">
                <h2 class="text-xl font-bold tracking-wide text-gray-500 uppercase p-5">Categories</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8">
                    @foreach ($categories as $category)
                    <a href="/categories/{{ $category->name }}">
                        <div class="flex justify-center items-center flex-col border bg-gray-50 p-5 cursor-pointer hover:bg-[#e6eaec] hover:shadow-lg">
                            <img class="h-20 w-20 object-cover object-center" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="">
                            <p class="font-semibold text-sm pt-2 overflow-hidden text-center max-h-7">{{ $category->name }}</p>
                        </div>  
                    </a> 
                    @endforeach
                </div>
            </div>

            <div class="mx-auto max-w-2xl py-8 sm:py-12 lg:max-w-7xl">
                <h2 class="text-xl font-bold tracking-wide text-gray-500 capitalize pl-5">Just For You</h2>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($just_for_you as $jfu)
                        <x-product-card :product='$jfu'/>
                    @endforeach
                </div>
                <div id="pagination" class="mt-5">{{ $just_for_you->onEachSide(0)->links() }}</div>
            </div>

            <div class="mx-auto max-w-2xl py-8 sm:py-12 lg:max-w-7xl">
                <h2 class="text-xl font-bold tracking-wide text-gray-500 capitalize pl-5">Customers Also Purchased</h2>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                     @foreach ($customers_also_purchased as $cap)
                        <x-product-card :product='$cap'/>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    
@endsection