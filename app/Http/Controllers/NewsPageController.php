<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use App\Support\HtmlSanitizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsPageController extends Controller
{
    public function index()
    {
        $posts = Pos::query()
            ->with('kategori')
            ->latest()
            ->paginate(12)
            ->through(fn($post) => [
                'slug' => $post->slug,
                'title' => $post->judul,
                'excerpt' => Str::limit(strip_tags((string) $post->konten)),
                'date' => $post->created_at?->format('d M Y'),
                'category' => $post->kategori?->nama ?? 'Uncategorized',
                'thumbnail' => $post->thumbnail ? Storage::url($post->thumbnail) : null,
            ]);

        return view('news.index', compact('posts'));
    }

    public function show(Pos $post)
    {
        $post->load('kategori');
        $postContentHtml = HtmlSanitizer::sanitizeArticleHtml($post->konten);

        $relatedPosts = Pos::query()
            ->with('kategori')
            ->where('id', '!=', $post->id)
            ->where('kategori_id', $post->kategori_id)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($relatedPost) => [
                'slug' => $relatedPost->slug,
                'title' => $relatedPost->judul,
                'excerpt' => Str::limit(strip_tags((string) $relatedPost->konten), 100),
                'date' => $relatedPost->created_at?->format('d M Y'),
                'thumbnail' => $relatedPost->thumbnail ? Storage::url($relatedPost->thumbnail) : null,
            ]);

        return view('news.show', compact('post', 'postContentHtml', 'relatedPosts'));
    }
}
