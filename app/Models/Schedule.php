<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'screen_id',
        'start_time',
        'end_time',
    ];

    // datetimeに意図的に変換
    protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
    ];

    public function movie():BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function reservations():HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function screen():BelongsTo
    {
        return $this->belongsTo(Screen::class);
    }

}
