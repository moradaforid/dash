<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sponsor extends Model
{
    protected $table = 'sponsors';

    use HasFactory;

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'sponsor_id');
    }
}
