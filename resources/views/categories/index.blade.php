@extends('layouts.landing')

@section('title', 'Blog - Kategori')

@section('content')
    @php
        $categoryIcon = static function (string $name): string {
            $label = \Illuminate\Support\Str::lower($name);

            return match (true) {
                \Illuminate\Support\Str::contains($label, ['teknologi', 'tech', 'ai', 'digital', 'software', 'program', 'coding']) => 'memory',
                \Illuminate\Support\Str::contains($label, ['bisnis', 'finance', 'keuangan', 'ekonomi', 'investasi', 'startup']) => 'trending_up',
                \Illuminate\Support\Str::contains($label, ['desain', 'design', 'ui', 'ux', 'kreatif']) => 'palette',
                \Illuminate\Support\Str::contains($label, ['marketing', 'pemasaran', 'seo', 'konten', 'brand']) => 'campaign',
                \Illuminate\Support\Str::contains($label, ['kesehatan', 'health', 'medis', 'wellness']) => 'favorite',
                \Illuminate\Support\Str::contains($label, ['olahraga', 'sport', 'sepak bola', 'basket']) => 'sports_soccer',
                \Illuminate\Support\Str::contains($label, ['pendidikan', 'edukasi', 'belajar', 'sekolah']) => 'school',
                \Illuminate\Support\Str::contains($label, ['travel', 'wisata', 'jalan', 'liburan']) => 'flight',
                \Illuminate\Support\Str::contains($label, ['makanan', 'kuliner', 'food', 'resep']) => 'restaurant',
                \Illuminate\Support\Str::contains($label, ['politik', 'pemerintah', 'hukum']) => 'gavel',
                default => 'folder',
            };
        };
    @endphp

    <section class="py-16">
        <div class="layout-container">
            <p class="text-sm font-bold mb-2">Kategori</p>
            <h1 class="text-3xl font-bold mb-4">Pilih topik yang ingin Anda ikuti</h1>
            <p class="text-text-muted-light dark:text-text-muted-dark mb-10">
                Jelajahi semua kategori dan temukan artikel sesuai minat Anda.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($categories as $category)
                    <a href="{{ route('categories.show', $category['id']) }}" class="group bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 hover:border-primary transition-colors">
                        <div class="w-12 h-12 mb-4 rounded-full bg-badge-bg-light dark:bg-badge-bg-dark text-badge-text-light dark:text-badge-text-dark flex items-center justify-center">
                            <span class="material-icons">{{ $categoryIcon($category['name']) }}</span>
                        </div>
                        <h2 class="text-xl font-bold mb-2 group-hover:text-primary">{{ $category['name'] }}</h2>
                        <p class="text-sm text-text-muted-light dark:text-text-muted-dark mb-4">
                            {{ $category['count'] }} artikel tersedia pada kategori ini.
                        </p>
                        <span class="inline-flex items-center gap-2 text-sm text-primary font-medium">
                            Lihat artikel
                            <span class="material-icons text-[16px]">arrow_outward</span>
                        </span>
                    </a>
                @empty
                    <div class="col-span-full bg-gray-50 dark:bg-gray-900 border border-border-light dark:border-border-dark rounded-xl p-8 text-center text-text-muted-light dark:text-text-muted-dark">
                        Belum ada kategori yang tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
