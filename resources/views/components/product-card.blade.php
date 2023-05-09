<div class="group relative">
    <div class="h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75">
        <img src="{{ $product->image_url }}" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center">
    </div>
    <div class="mt-4 flex justify-between">
    <div>
        <h3 class="text-sm text-gray-700">
        <a href="/products/{{ $product->id }}">
            <span aria-hidden="true" class="absolute inset-0"></span>
            {{ $product->name }}
        </a>
        </h3>
        <p class="mt-1 text-sm text-gray-500">{{ $product->quantity }}</p>
    </div>
    <p class="text-sm font-medium text-gray-900" style="font-family: 'Poppins', 'Times New Roman'">$ {{ $product->price }}</p>
    </div>
</div>