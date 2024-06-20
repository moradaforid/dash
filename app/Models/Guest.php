<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Guest extends Model
{
    protected $table = 'guests';

    use HasFactory;

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'guest_id');
    }

    public function test(): HasOne
    {
        return $this->hasOne(Test::class, 'guest_id');
    }
}
