<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryPageController extends Controller
{
    public function index()
    {
        $categories = Kategori::query()
            ->withCount('pos')
            ->orderBy('nama')
            ->get()
            ->map(fn($category) => [
                'id' => $category->id,
                'name' => $category->nama,
                'count' => $category->pos_count,
            ]);

        return view('categories.index', compact('categories'));
    }

    public function show(Kategori $kategori)
    {
        $posts = Pos::query()
            ->with('kategori')
            ->where('kategori_id', $kategori->id)
            ->latest()
            ->take(12)
            ->get()
            ->map(fn($post) => [
                'slug' => $post->slug,
                'title' => $post->judul,
                'excerpt' => Str::limit(strip_tags((string) $post->konten)),
                'date' => $post->created_at?->format('d M Y'),
                'category' => $post->kategori?->nama ?? 'Uncategorized',
                'thumbnail' => $post->thumbnail ? Storage::url($post->thumbnail) : null,
            ]);

        return view('categories.show', compact('kategori', 'posts'));
    }
}
