<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $featured = Blog::published()
            ->with(['author', 'category'])
            ->latest('published_at')
            ->first();

        $posts = Blog::published()
            ->with(['author', 'category'])
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->latest('published_at')
            ->paginate(9);

        // Show the hero only on the first page
        if ($request->integer('page', 1) > 1) {
            $featured = null;
        }

        return view('blog.index', [
            'featured'   => $featured,
            'posts'      => $posts,
            'categories' => $this->categories(),
        ]);
    }

    public function show(string $slug)
    {
        $blog = Blog::published()
            ->with(['author', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Blog::published()
            ->with(['author', 'category'])
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('blog', 'related'));
    }

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Blog::published()
            ->with(['author', 'category'])
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(9);

        return view('blog.category', [
            'category'   => $category,
            'posts'      => $posts,
            'categories' => $this->categories(),
        ]);
    }

    private function categories()
    {
        return Category::whereHas('blogs', fn($q) => $q->published())
            ->orderBy('name')
            ->get();
    }
}
