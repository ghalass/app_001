<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parc extends Model
{
    protected $fillable = [
        'name',
        'description',
        'typeparc_id',
    ];

    public function typeparc(): BelongsTo
    {
        return $this->belongsTo(Typeparc::class);
    }
}
