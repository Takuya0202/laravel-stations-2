<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image_url',
        'published_year',
        'is_showing',
        'description',
        'genre_id'
    ];


    public function genre():BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function schedules():HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
