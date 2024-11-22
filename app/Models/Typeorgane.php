<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Typeorgane extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function organes(): HasMany
    {
        return $this->hasMany(Organe::class);
    }
}
