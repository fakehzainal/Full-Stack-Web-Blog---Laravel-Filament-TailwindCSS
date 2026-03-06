<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pos extends Model
{
    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'konten',
        'thumbnail',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
