<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function engins(): HasMany
    {
        return $this->hasMany(Engin::class);
    }
}