<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'typeorgane_id',
    ];

    public function typeorgane(): BelongsTo
    {
        return $this->belongsTo(Typeorgane::class);
    }

    public function engins(): HasMany
    {
        return $this->hasMany(Engin::class);
    }
}