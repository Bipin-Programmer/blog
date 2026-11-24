@extends('layouts.app')

@section('title', $blog->title . ' - ' . config('app.name'))

@section('content')

    <article class="mx-auto max-w-3xl">

        <a href="{{ route('category.show', $blog->category->slug) }}"
            class="text-xs font-semibold uppercase tracking-wide text-indigo-600 hover:underline">
            {{ $blog->category->name }}
        </a>

        <h1 class="mt-3 text-4xl font-bold leading-tight">{{ $blog->title }}</h1>

        <p class="mt-4 text-sm text-gray-500">
            By {{ $blog->author->name }} &middot;
            {{ $blog->published_at->format('M d, Y') }} &middot;
            {{ $blog->reading_time }} min read
        </p>

        @if ($blog->thumbnail_url)
            <div class="mt-8 aspect-video overflow-hidden rounded-xl bg-gray-200">
                <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}" class="h-full w-full object-cover"
                    onerror="this.remove()">
            </div>
        @endif

        <div class="prose prose-lg prose-indigo mt-8 max-w-none">
            {!! $blog->content !!}
        </div>

        {{-- Author box --}}
        <div class="mt-12 flex items-start gap-4 rounded-xl border border-gray-200 bg-white p-6">
            @if ($blog->author->avatar_url)
                <img src="{{ $blog->author->avatar_url }}" alt="{{ $blog->author->name }}"
                    class="h-16 w-16 shrink-0 rounded-full bg-gray-200 object-cover" onerror="this.remove()">
            @else
                <div
                    class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-xl font-bold text-indigo-600">
                    {{ strtoupper(substr($blog->author->name, 0, 1)) }}
                </div>
            @endif

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Written by</p>
                <p class="text-lg font-bold">{{ $blog->author->name }}</p>
                @if ($blog->author->job_title)
                    <p class="text-sm text-indigo-600">{{ $blog->author->job_title }}</p>
                @endif
                @if ($blog->author->bio)
                    <p class="mt-2 text-sm text-gray-600">{{ $blog->author->bio }}</p>
                @endif
            </div>
        </div>
    </article>

    @if ($related->count())
        <section class="mt-16">
            <h2 class="mb-6 text-2xl font-bold">More in {{ $blog->category->name }}</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($related as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        </section>
    @endif

@endsection
