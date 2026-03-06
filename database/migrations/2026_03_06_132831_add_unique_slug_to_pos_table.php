<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $existingPosts = DB::table('pos')
            ->select(['id', 'slug'])
            ->orderBy('id')
            ->get();

        $usedSlugs = [];

        foreach ($existingPosts as $post) {
            $baseSlug = Str::slug((string) $post->slug);
            if ($baseSlug === '') {
                $baseSlug = 'post-' . $post->id;
            }

            $candidateSlug = $baseSlug;
            $suffix = 2;

            while (isset($usedSlugs[$candidateSlug])) {
                $candidateSlug = $baseSlug . '-' . $suffix;
                $suffix++;
            }

            $usedSlugs[$candidateSlug] = true;

            if ($candidateSlug !== $post->slug) {
                DB::table('pos')
                    ->where('id', $post->id)
                    ->update(['slug' => $candidateSlug]);
            }
        }

        Schema::table('pos', function (Blueprint $table): void {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pos', function (Blueprint $table): void {
            $table->dropUnique('pos_slug_unique');
        });
    }
};

