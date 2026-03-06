@extends('layouts.landing')

@section('title', 'Blog - Tentang Kami')

@section('content')
    <section class="py-20">
        <div class="layout-container grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div>
                <p class="text-sm font-bold mb-2">Tentang Kami</p>
                <h1 class="text-4xl font-bold leading-tight mb-6">
                    Kami membantu tim membangun produk digital yang berdampak.
                </h1>
                <p class="text-text-muted-light dark:text-text-muted-dark mb-8">
                    INK Blog adalah media pembelajaran praktis untuk manajer produk, desainer, pengembang, dan pendiri startup.
                    Kami berbagi strategi, eksperimen nyata, dan studi kasus dari dunia produk digital.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-xl p-4">
                        <p class="text-2xl font-bold">1M+</p>
                        <p class="text-sm text-text-muted-light dark:text-text-muted-dark">Pembaca aktif</p>
                    </div>
                    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-xl p-4">
                        <p class="text-2xl font-bold">500+</p>
                        <p class="text-sm text-text-muted-light dark:text-text-muted-dark">Artikel terbit</p>
                    </div>
                    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-xl p-4">
                        <p class="text-2xl font-bold">50+</p>
                        <p class="text-sm text-text-muted-light dark:text-text-muted-dark">Kontributor ahli</p>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden border border-border-light dark:border-border-dark">
                <img alt="Ruang kerja tim" class="w-full h-full object-cover min-h-[320px]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDN2EAKraxfLgEbfJxCzAZ3vvLq2MFODvpFTuXAZmtmvwKk0H6mSxQueIhNYhbtC53SARWR5N4I74X3Ka5z_wtJj1AFLzrJv5V8JUQ-kl6yUMlZbzPIVZ00tDEKbg--pkJBoXZpIL3w82W8W894tYMp_Gvfp7AfIeL318ryR0aOw4IS1CZfUXKoAwgmUyEEpI4a1OkWeICSTQoUbKhCJWYv8kRO5M_jTXRJAM-jU9DYrB9jBtdp0rIteE1OZbZ7T5vNYrfRfNj3FY">
            </div>
        </div>
    </section>
@endsection
