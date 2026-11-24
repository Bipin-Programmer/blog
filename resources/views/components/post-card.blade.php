@props(['post'])

<article class="flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white transition hover:shadow-lg">
    <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-video bg-gray-200">
        @if ($post->thumbnail_url)
            <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="h-full w-full object-cover"
                loading="lazy" onerror="this.remove()">
        @endif
    </a>

    <div class="flex flex-1 flex-col p-5">
        <a href="{{ route('category.show', $post->category->slug) }}"
            class="text-xs font-semibold uppercase tracking-wide text-indigo-600 hover:underline">
            {{ $post->category->name }}
        </a>

        <h2 class="mt-2 text-lg font-bold leading-snug">
            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-indigo-600">
                {{ $post->title }}
            </a>
        </h2>

        <p class="mt-2 flex-1 text-sm text-gray-600">
            {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
        </p>

        <p class="mt-4 text-xs text-gray-500">
            {{ $post->author->name }} &middot;
            {{ $post->published_at->format('M d, Y') }} &middot;
            {{ $post->reading_time }} min read
        </p>
    </div>
</article>
