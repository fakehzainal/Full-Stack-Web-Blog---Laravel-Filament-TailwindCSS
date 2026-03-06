@extends('layouts.landing')

@section('title', 'Blog - ' . $post->judul)

@section('content')
    <section class="py-14">
        <div class="layout-container-narrow">
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-sm text-text-muted-light dark:text-text-muted-dark hover:text-primary mb-6">
                <span class="material-icons text-[16px]">west</span>
                Kembali ke semua berita
            </a>

            <div class="mb-6">
                <span class="inline-flex px-3 py-1 bg-badge-bg-light dark:bg-badge-bg-dark text-badge-text-light dark:text-badge-text-dark text-xs font-semibold rounded-full">
                    {{ $post->kategori?->nama ?? 'Tanpa Kategori' }}
                </span>
                <h1 class="text-3xl md:text-4xl font-bold leading-tight mt-4 mb-4">{{ $post->judul }}</h1>
                <div class="text-sm text-text-muted-light dark:text-text-muted-dark flex items-center gap-2">
                    <span class="material-icons text-[16px]">calendar_today</span>
                    <span>{{ $post->created_at?->format('d M Y') ?? '-' }}</span>
                </div>
            </div>

            <div class="rounded-2xl overflow-hidden bg-gray-100 dark:bg-gray-800 mb-8 border border-border-light dark:border-border-dark">
                @if ($post->thumbnail)
                    <img alt="{{ $post->judul }}" class="w-full h-[300px] md:h-[440px] object-cover" src="{{ \Illuminate\Support\Facades\Storage::url($post->thumbnail) }}">
                @else
                    <div class="w-full h-[300px] md:h-[440px] flex items-center justify-center text-sm text-gray-500">
                        Tanpa Gambar
                    </div>
                @endif
            </div>

            <article class="prose prose-lg max-w-none dark:prose-invert prose-headings:font-bold prose-a:text-primary">
                {!! $postContentHtml !!}
            </article>
        </div>
    </section>

    @if ($relatedPosts->isNotEmpty())
        <section class="py-14 border-t border-border-light dark:border-border-dark">
            <div class="layout-container">
                <h2 class="text-2xl font-bold mb-8">Artikel Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relatedPosts as $relatedPost)
                        <article class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-xl p-4">
                            <div class="overflow-hidden rounded-lg mb-4 h-40 bg-gray-100 dark:bg-gray-800">
                                <a href="{{ route('news.show', $relatedPost['slug']) }}" class="block h-full">
                                    @if ($relatedPost['thumbnail'])
                                        <img alt="{{ $relatedPost['title'] }}" class="w-full h-full object-cover" src="{{ $relatedPost['thumbnail'] }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-xs text-gray-500">
                                            Tanpa Gambar
                                        </div>
                                    @endif
                                </a>
                            </div>
                            <p class="text-xs text-text-muted-light dark:text-text-muted-dark mb-2">{{ $relatedPost['date'] ?? '-' }}</p>
                            <h3 class="font-bold leading-snug mb-2 line-clamp-2">
                                <a href="{{ route('news.show', $relatedPost['slug']) }}" class="hover:text-primary">{{ $relatedPost['title'] }}</a>
                            </h3>
                            <p class="text-sm text-text-muted-light dark:text-text-muted-dark line-clamp-3">{{ $relatedPost['excerpt'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
