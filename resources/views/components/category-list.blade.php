<ul role="list" class="px-2 py-3 font-medium text-gray-900">
    @foreach ($categories as $item)
        <li><a href="/categories/{{ $item->name }}" class="block px-2 py-3">{{ $item->name }}</a></li>   
    @endforeach
</ul>