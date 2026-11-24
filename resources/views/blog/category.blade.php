@extends('layouts.app')

@section('title', $category->name . ' - ' . config('app.name'))

@section('content')

    <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
    @if ($category->description)
        <p class="mt-2 text-gray-600">{{ $category->description }}</p>
    @endif

    @include('blog._categories', ['active' => $category->id])

    @if ($posts->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>

        <div class="mt-10">{{ $posts->links() }}</div>
    @else
        <p class="py-20 text-center text-gray-500">No posts in this category yet.</p>
    @endif

@endsection
