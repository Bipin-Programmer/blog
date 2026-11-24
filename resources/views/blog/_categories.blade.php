<div class="my-8 flex flex-wrap gap-2">
    <a href="{{ route('home') }}"
        class="rounded-full px-4 py-1.5 text-sm font-medium {{ $active ? 'bg-white text-gray-700 border border-gray-200 hover:border-indigo-400' : 'bg-indigo-600 text-white' }}">
        All
    </a>
    @foreach ($categories as $cat)
        <a href="{{ route('category.show', $cat->slug) }}"
            class="rounded-full px-4 py-1.5 text-sm font-medium {{ $active === $cat->id ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 border border-gray-200 hover:border-indigo-400' }}">
            {{ $cat->name }}
        </a>
    @endforeach
</div>
