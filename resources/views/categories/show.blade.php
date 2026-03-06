@extends('layouts.landing')

@section('title', 'Blog - ' . $kategori->nama)

@section('content')
    <section class="py-16">
        <div class="layout-container">
            <div class="mb-8">
                <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 text-sm text-text-muted-light dark:text-text-muted-dark hover:text-primary">
                    <span class="material-icons text-[16px]">west</span>
                    Kembali ke kategori
                </a>
                <h1 class="text-3xl font-bold mt-4 mb-2">{{ $kategori->nama }}</h1>
                <p class="text-text-muted-light dark:text-text-muted-dark">Kumpulan berita pada kategori ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($posts as $post)
                    <article class="flex flex-col group">
                        <div class="overflow-hidden rounded-xl mb-4 h-48 bg-gray-100 dark:bg-gray-800">
                            <a href="{{ route('news.show', $post['slug']) }}" class="block w-full h-full">
                                @if ($post['thumbnail'])
                                    <img alt="{{ $post['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $post['thumbnail'] }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-xs text-gray-500">
                                        Tanpa Gambar
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs text-text-muted-light dark:text-text-muted-dark flex items-center gap-1">
                                <span class="material-icons text-[14px]">calendar_today</span> {{ $post['date'] ?? '-' }}
                            </span>
                            <span class="px-2 py-1 bg-badge-bg-light dark:bg-badge-bg-dark text-badge-text-light dark:text-badge-text-dark text-xs font-semibold rounded">
                                {{ $post['category'] }}
                            </span>
                        </div>
                        <h3 class="text-lg font-bold mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                            <a href="{{ route('news.show', $post['slug']) }}">{{ $post['title'] }}</a>
                        </h3>
                        <p class="text-sm text-text-muted-light dark:text-text-muted-dark line-clamp-3">{{ $post['excerpt'] }}</p>
                    </article>
                @empty
                    <div class="col-span-full bg-gray-50 dark:bg-gray-900 border border-border-light dark:border-border-dark rounded-xl p-8 text-center text-text-muted-light dark:text-text-muted-dark">
                        Belum ada berita untuk kategori ini.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
