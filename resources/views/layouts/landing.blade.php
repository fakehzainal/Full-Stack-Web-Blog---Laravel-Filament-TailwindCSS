<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'INK Blog - Cerita, Insight, dan Tren Terkini')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#0f62fe",
                        "background-light": "#f4f7ff",
                        "background-dark": "#0d1117",
                        "surface-light": "#ffffff",
                        "surface-dark": "#161b22",
                        "text-light": "#1f2937",
                        "text-dark": "#c9d1d9",
                        "text-muted-light": "#6b7280",
                        "text-muted-dark": "#8b949e",
                        "border-light": "#e5e7eb",
                        "border-dark": "#30363d",
                        "badge-bg-light": "#e0e7ff",
                        "badge-bg-dark": "#1e3a8a",
                        "badge-text-light": "#3730a3",
                        "badge-text-dark": "#a5b4fc",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                    },
                },
            },
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: "Inter", sans-serif;
        }

        .layout-container {
            max-width: 72rem;
            margin-inline: auto;
            padding-inline: 1.5rem;
        }

        .layout-container-narrow {
            max-width: 56rem;
            margin-inline: auto;
            padding-inline: 1.5rem;
        }

        @media (min-width: 768px) {
            .layout-container,
            .layout-container-narrow {
                padding-inline: 3rem;
            }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark min-h-screen antialiased flex flex-col">
    <nav class="bg-background-light dark:bg-background-dark border-b border-border-light dark:border-border-dark">
        <div class="layout-container py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-bold">in</div>
                <span class="font-bold text-xl tracking-tight">INK</span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a class="{{ request()->routeIs('home') ? 'text-primary' : 'text-text-muted-light dark:text-text-muted-dark' }} hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a>
                <div class="relative group">
                    <a class="inline-flex items-center gap-1 {{ request()->routeIs('categories.*') ? 'text-primary' : 'text-text-muted-light dark:text-text-muted-dark' }} hover:text-primary transition-colors" href="{{ route('categories.index') }}">
                        Kategori
                        <span class="material-icons text-base">expand_more</span>
                    </a>
                    @if (!empty($navCategories) && $navCategories->isNotEmpty())
                        <div class="absolute left-0 top-full pt-3 z-20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <div class="w-[28rem] rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-surface-dark shadow-lg p-3">
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach ($navCategories as $navCategory)
                                        <a href="{{ route('categories.show', $navCategory->id) }}" class="block px-3 py-2 rounded-lg text-sm text-text-muted-light dark:text-text-muted-dark hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-primary transition-colors">
                                            {{ $navCategory->nama }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <a class="{{ request()->routeIs('news.*') ? 'text-primary' : 'text-text-muted-light dark:text-text-muted-dark' }} hover:text-primary transition-colors" href="{{ route('news.index') }}">Berita</a>
                <a class="{{ request()->routeIs('about.*') ? 'text-primary' : 'text-text-muted-light dark:text-text-muted-dark' }} hover:text-primary transition-colors" href="{{ route('about.index') }}">Tentang Kami</a>
            </div>
            <a href="{{ route('about.index') }}" class="hidden md:inline-flex px-4 py-2 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-sm font-medium">
                Kirim Tulisan
            </a>

            <details class="md:hidden relative">
                <summary class="list-none w-10 h-10 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-surface-dark flex items-center justify-center cursor-pointer">
                    <span class="material-icons">menu</span>
                </summary>
                <div class="absolute right-0 top-full mt-3 w-72 rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-surface-dark shadow-lg p-3 z-30">
                    <div class="flex flex-col">
                        <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm {{ request()->routeIs('home') ? 'text-primary bg-gray-100 dark:bg-gray-800' : 'text-text-muted-light dark:text-text-muted-dark' }}">
                            Beranda
                        </a>
                        <a href="{{ route('news.index') }}" class="px-3 py-2 rounded-lg text-sm {{ request()->routeIs('news.*') ? 'text-primary bg-gray-100 dark:bg-gray-800' : 'text-text-muted-light dark:text-text-muted-dark' }}">
                            Berita
                        </a>
                        <a href="{{ route('about.index') }}" class="px-3 py-2 rounded-lg text-sm {{ request()->routeIs('about.*') ? 'text-primary bg-gray-100 dark:bg-gray-800' : 'text-text-muted-light dark:text-text-muted-dark' }}">
                            Tentang Kami
                        </a>
                        <a href="{{ route('categories.index') }}" class="px-3 py-2 rounded-lg text-sm {{ request()->routeIs('categories.*') ? 'text-primary bg-gray-100 dark:bg-gray-800' : 'text-text-muted-light dark:text-text-muted-dark' }}">
                            Semua Kategori
                        </a>

                        @if (!empty($navCategories) && $navCategories->isNotEmpty())
                            <div class="border-t border-border-light dark:border-border-dark mt-2 pt-2">
                                <p class="px-3 py-1 text-xs font-semibold uppercase tracking-wider text-text-muted-light dark:text-text-muted-dark">Kategori Populer</p>
                                @foreach ($navCategories->take(4) as $navCategory)
                                    <a href="{{ route('categories.show', $navCategory->id) }}" class="block px-3 py-2 rounded-lg text-sm text-text-muted-light dark:text-text-muted-dark hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-primary transition-colors">
                                        {{ $navCategory->nama }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('about.index') }}" class="mt-3 inline-flex justify-center px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium">
                            Kirim Tulisan
                        </a>
                    </div>
                </div>
            </details>
        </div>
    </nav>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-background-light dark:bg-background-dark border-t border-border-light dark:border-border-dark py-8">
        <div class="layout-container flex flex-col md:flex-row justify-between items-center gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-6 h-6 bg-primary rounded-full flex items-center justify-center text-white font-bold text-xs">i</div>
                <span class="font-bold text-lg tracking-tight">INK</span>
            </a>
            <div class="flex flex-wrap justify-center gap-6 text-sm font-medium text-gray-400">
                &copy; {{ now()->year }} INK Blog. Semua hak cipta dilindungi.
            </div>
            <div class="flex gap-4">
                <span class="text-gray-400"><span class="material-icons text-xl">facebook</span></span>
                <span class="text-gray-400"><span class="material-icons text-xl">camera_alt</span></span>
                <span class="text-gray-400"><span class="material-icons text-xl">flutter_dash</span></span>
                <span class="text-gray-400"><span class="material-icons text-xl">link</span></span>
            </div>
        </div>
    </footer>
</body>
</html>
