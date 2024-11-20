<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Engin extends Model
{
    protected $fillable = [
        'name',
        'description',
        'parc_id',
        'site_id',
    ];

    public function parc(): BelongsTo
    {
        return $this->belongsTo(Parc::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}