<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Typelubrifiant extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function lubrifiants(): HasMany
    {
        return $this->hasMany(Lubrifiant::class);
    }
}
