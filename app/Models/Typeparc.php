<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Typeparc extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function parcs(): HasMany
    {
        return $this->hasMany(Parc::class);
    }
}
