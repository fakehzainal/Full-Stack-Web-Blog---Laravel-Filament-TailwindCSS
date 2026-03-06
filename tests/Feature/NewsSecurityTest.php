<?php

use App\Models\Kategori;
use App\Models\Pos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

it('renders sanitized html on news detail page', function () {
    $kategori = Kategori::query()->create([
        'nama' => 'Teknologi',
    ]);

    $post = Pos::query()->create([
        'kategori_id' => $kategori->id,
        'judul' => 'Konten Aman',
        'slug' => 'konten-aman',
        'konten' => '<p>Paragraf aman</p><script>alert("xss")</script><img src="x" onerror="alert(1)">',
    ]);

    $response = $this->get(route('news.show', $post->slug));

    $response->assertOk();
    $response->assertSee('Paragraf aman', false);
    $response->assertDontSee('alert("xss")', false);
    $response->assertDontSee('onerror=', false);
});

it('enforces unique slug at database level', function () {
    $kategori = Kategori::query()->create([
        'nama' => 'Bisnis',
    ]);

    $sameSlug = Str::slug('judul-sama');

    Pos::query()->create([
        'kategori_id' => $kategori->id,
        'judul' => 'Judul Pertama',
        'slug' => $sameSlug,
        'konten' => 'Konten pertama',
    ]);

    $this->expectException(\Illuminate\Database\QueryException::class);

    Pos::query()->create([
        'kategori_id' => $kategori->id,
        'judul' => 'Judul Kedua',
        'slug' => $sameSlug,
        'konten' => 'Konten kedua',
    ]);
});
