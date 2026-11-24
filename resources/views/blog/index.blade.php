@extends('layouts.app')

@section('title', config('app.name'))

@section('content')

    @if ($featured)
        <article class="grid overflow-hidden rounded-2xl border border-gray-200 bg-white md:grid-cols-2">
            <a href="{{ route('blog.show', $featured->slug) }}" class="block aspect-video bg-gray-200 md:aspect-auto">
                @if ($featured->thumbnail_url)
                    <img src="{{ $featured->thumbnail_url }}" alt="{{ $featured->title }}" class="h-full w-full object-cover"
                        onerror="this.remove()">
                @endif
            </a>
            <div class="flex flex-col justify-center p-6 md:p-10">
                <a href="{{ route('category.show', $featured->category->slug) }}"
                    class="text-xs font-semibold uppercase tracking-wide text-indigo-600 hover:underline">
                    {{ $featured->category->name }}
                </a>
                <h1 class="mt-3 text-3xl font-bold leading-tight">
                    <a href="{{ route('blog.show', $featured->slug) }}" class="hover:text-indigo-600">
                        {{ $featured->title }}
                    </a>
                </h1>
                <p class="mt-3 text-gray-600">
                    {{ $featured->excerpt ?: Str::limit(strip_tags($featured->content), 180) }}
                </p>
                <p class="mt-5 text-sm text-gray-500">
                    {{ $featured->author->name }} &middot;
                    {{ $featured->published_at->format('M d, Y') }} &middot;
                    {{ $featured->reading_time }} min read
                </p>
                <a href="{{ route('blog.show', $featured->slug) }}"
                    class="mt-6 inline-block w-fit rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                    Read article
                </a>
            </div>
        </article>
    @endif

    @include('blog._categories', ['active' => null])

    @if ($posts->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>

        <div class="mt-10">{{ $posts->links() }}</div>
    @elseif (!$featured)
        <p class="py-20 text-center text-gray-500">No posts published yet.</p>
    @endif

@endsection
