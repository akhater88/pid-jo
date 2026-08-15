<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(): View
    {
        $posts = BlogPost::query()
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('blog.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display the specified blog post.
     */
    public function show(string $slug): View
    {
        $currentLocale = app()->getLocale();
        $fallbackLocale = 'en';

        // Try to find blog post by slug in current locale, fallback to English if not found
        $post = BlogPost::query()
            ->where(function ($query) use ($currentLocale, $slug, $fallbackLocale) {
                $query->where('slug->' . $currentLocale, $slug)
                    ->orWhere('slug->' . $fallbackLocale, $slug);
            })
            ->published()
            ->firstOrFail();

        // Get recent posts for sidebar
        $recentPosts = BlogPost::query()
            ->published()
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        return view('blog.show', [
            'post' => $post,
            'recentPosts' => $recentPosts,
            'title' => $post->title,
            'seoTitle' => $post->title,
            'seoDescription' => $post->excerpt,
        ]);
    }
}
