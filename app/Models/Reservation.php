<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'sheet_id',
        'date',
        'email',
        'name',
        'is_cancel'
    ];

    public function sheet():BelongsTo
    {
        return $this->belongsTo(Sheet::class);
    }

    public function schedules():BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
}
