@extends('layouts.landing')

@section('title', 'Blog - Beranda')

@section('content')
    @php
        $featuredPost = $posts->first();
        $latestPosts = $posts->slice(1, 2);
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

    <section class="py-14 md:py-20">
        <div class="layout-container grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                @if ($featuredPost)
                    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden h-full lg:min-h-[620px] flex flex-col">
                        <div class="h-64 md:h-80 lg:h-[340px] bg-gray-100 dark:bg-gray-800">
                            @if ($featuredPost['thumbnail'])
                                <img alt="{{ $featuredPost['title'] }}" class="w-full h-full object-cover" src="{{ $featuredPost['thumbnail'] }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-xs text-gray-500">
                                    Tanpa Gambar
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex-1">
                            <p class="text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-3 uppercase tracking-wider">
                                Artikel Utama
                            </p>
                            <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4">
                                <a href="{{ route('news.show', $featuredPost['slug']) }}" class="hover:text-primary transition-colors">
                                    {{ $featuredPost['title'] }}
                                </a>
                            </h1>
                            <p class="text-text-muted-light dark:text-text-muted-dark mb-6 line-clamp-3">{{ $featuredPost['excerpt'] }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-text-muted-light dark:text-text-muted-dark">
                                    {{ $featuredPost['date'] ?? '-' }} - {{ $featuredPost['category'] }}
                                </span>
                                <a href="{{ route('news.show', $featuredPost['slug']) }}" class="inline-flex items-center gap-2 text-primary text-sm font-semibold">
                                    Baca artikel
                                    <span class="material-icons text-[16px]">arrow_outward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-gray-50 dark:bg-gray-900 border border-border-light dark:border-border-dark rounded-2xl p-10 text-center text-text-muted-light dark:text-text-muted-dark">
                        Belum ada berita terbaru untuk ditampilkan.
                    </div>
                @endif
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 h-full lg:min-h-[620px] flex flex-col">
                    <h2 class="text-lg font-bold mb-5">Artikel Terbaru</h2>
                    <div class="grid grid-rows-2 gap-4 flex-1">
                        @forelse ($latestPosts as $post)
                            <article class="border border-border-light dark:border-border-dark rounded-xl p-3 h-full">
                                <div class="h-full flex flex-col">
                                    <div class="w-full h-28 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 mb-3">
                                        @if ($post['thumbnail'])
                                            <img alt="{{ $post['title'] }}" class="w-full h-full object-cover" src="{{ $post['thumbnail'] }}">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-500">
                                                Tanpa Gambar
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-text-muted-light dark:text-text-muted-dark mb-2">{{ $post['date'] ?? '-' }}</p>
                                        <h3 class="font-semibold leading-snug line-clamp-2 mb-2">
                                            <a href="{{ route('news.show', $post['slug']) }}" class="hover:text-primary transition-colors">{{ $post['title'] }}</a>
                                        </h3>
                                        <span class="inline-flex px-2 py-1 bg-badge-bg-light dark:bg-badge-bg-dark text-badge-text-light dark:text-badge-text-dark text-xs font-semibold rounded">
                                            {{ $post['category'] }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p class="text-sm text-text-muted-light dark:text-text-muted-dark">Belum ada daftar berita terbaru.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white dark:bg-surface-dark border-t border-border-light dark:border-border-dark">
        <div class="layout-container">
            <p class="text-sm font-bold mb-2">Blog</p>
            <h2 class="text-3xl font-bold mb-4">Artikel, Cerita, dan Wawasan Terkini</h2>
            <p class="text-text-muted-light dark:text-text-muted-dark mb-8">
                Temukan tulisan terbaru seputar teknologi, kreativitas, bisnis, dan gaya hidup digital.
            </p>

            @if ($topCategories->isNotEmpty())
                <div class="flex flex-wrap gap-2 mb-8">
                    <a href="{{ route('news.index') }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-full text-sm font-medium">Semua</a>
                    @foreach ($topCategories as $category)
                        <a href="{{ route('categories.show', $category['id']) }}" class="px-4 py-2 text-text-muted-light dark:text-text-muted-dark rounded-full text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-800">
                            {{ $category['name'] }} ({{ $category['count'] }})
                        </a>
                    @endforeach
                </div>
            @endif

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
                        <h3 class="text-lg font-bold mb-2 group-hover:text-primary transition-colors line-clamp-2">
                            <a href="{{ route('news.show', $post['slug']) }}">{{ $post['title'] }}</a>
                        </h3>
                        <p class="text-sm text-text-muted-light dark:text-text-muted-dark mb-4 line-clamp-3 flex-1">{{ $post['excerpt'] }}</p>
                        <a href="{{ route('news.show', $post['slug']) }}" class="inline-flex items-center gap-2 text-sm font-medium text-primary">
                            Baca selengkapnya
                            <span class="material-icons text-[16px]">arrow_outward</span>
                        </a>
                    </article>
                @empty
                    <div class="col-span-full bg-gray-50 dark:bg-gray-900 border border-border-light dark:border-border-dark rounded-xl p-8 text-center text-text-muted-light dark:text-text-muted-dark">
                        Belum ada berita yang dipublikasikan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-14 border-t border-border-light dark:border-border-dark">
        <div class="layout-container">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="text-sm font-bold mb-2">Kategori Pilihan</p>
                    <h2 class="text-2xl md:text-3xl font-bold">Temukan Topik Sesuai Minat Anda</h2>
                </div>
                <a href="{{ route('categories.index') }}" class="hidden md:inline-flex items-center gap-2 text-sm text-primary font-semibold">
                    Lihat semua kategori
                    <span class="material-icons text-[16px]">arrow_outward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse ($categoryHighlights as $category)
                    <a href="{{ route('categories.show', $category['id']) }}" class="group bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-xl p-5 hover:border-primary transition-colors">
                        <div class="w-10 h-10 rounded-full bg-badge-bg-light dark:bg-badge-bg-dark text-badge-text-light dark:text-badge-text-dark flex items-center justify-center mb-3">
                            <span class="material-icons text-base">{{ $categoryIcon($category['name']) }}</span>
                        </div>
                        <h3 class="font-bold text-base mb-1 group-hover:text-primary transition-colors">{{ $category['name'] }}</h3>
                        <p class="text-xs text-text-muted-light dark:text-text-muted-dark">{{ $category['count'] }} artikel</p>
                    </a>
                @empty
                    <div class="col-span-full bg-gray-50 dark:bg-gray-900 border border-border-light dark:border-border-dark rounded-xl p-8 text-center text-text-muted-light dark:text-text-muted-dark">
                        Kategori belum tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-20 bg-background-light dark:bg-background-dark border-t border-border-light dark:border-border-dark">
        <div class="layout-container">
            <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 md:p-8 shadow-sm border border-border-light dark:border-border-dark flex flex-col md:flex-row max-w-5xl w-full mx-auto gap-8 items-center">
                <div class="w-full md:w-1/2 rounded-xl overflow-hidden">
                    <img alt="Meja kerja" class="w-full h-64 object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBN5n-DBsbqJt_2dlXjXDhoQt2mKi_JBg_fJrH2Fdo19BnNSN-J0MwSx2QV1E912nEL_dWa-l8oQUgEXA6wK9vXS0WCgpbmaWjvgzybGy-GWIb7vpcsW6MiPgtAvidw6BtlXjmWRNk_B5urIZ3fGAvEUBfu-y9lrpECOwwyuLgSE8spgJDUrq3fu5NcUy6iaoK2QEJNvCGSYMMG_dPF06uYDqggPMT_rHwUVOMOsjqSejtb4smjKjwGBGSmGHaTfO9nmW5F24ooLpc">
                </div>
                <div class="w-full md:w-1/2 flex flex-col justify-center">
                    <p class="text-xs font-semibold tracking-wider uppercase text-primary mb-2">Newsletter Mingguan</p>
                    <h2 class="text-2xl font-bold mb-3">Dapatkan ringkasan artikel terbaru setiap minggu</h2>
                    <p class="text-sm text-text-muted-light dark:text-text-muted-dark mb-6">
                        Kami mengirim pilihan artikel paling menarik langsung ke inbox Anda. Ringkas, relevan, dan tanpa spam.
                    </p>
                    <form class="w-full">
                        <div class="flex w-full gap-2 bg-gray-50 dark:bg-gray-900 p-2 rounded-lg border border-border-light dark:border-border-dark">
                            <input class="flex-1 px-4 py-2 bg-transparent border-none focus:ring-0 text-sm outline-none" placeholder="contoh@email.com" type="email">
                            <button class="px-6 py-2 bg-primary text-white rounded-md font-medium hover:bg-blue-600 transition-colors text-sm whitespace-nowrap" type="submit">
                                Berlangganan
                            </button>
                        </div>
                        <p class="text-xs text-text-muted-light dark:text-text-muted-dark mt-3">
                            Dengan berlangganan, Anda menyetujui kebijakan privasi kami. Anda bisa berhenti berlangganan kapan saja.
                        </p>
                    </form>
                    <div class="mt-4 text-xs text-text-muted-light dark:text-text-muted-dark">
                        Sudah bergabung: <span class="font-semibold text-text-light dark:text-text-dark">1.000.000+ pembaca</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
