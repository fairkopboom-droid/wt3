<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'artist',
        'label',
        'full_description',
        'release_date',
        'cover_image',
        'tracks',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function getTracksArrayAttribute(): array
    {
        if (!$this->tracks) {
            return [];
        }
        return array_filter(array_map('trim', explode("\n", $this->tracks)));
    }
}