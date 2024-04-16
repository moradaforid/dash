<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceProvider extends Model
{
    protected $table = 'service_providers';

    use HasFactory;

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class, 'service_provider_id');
    }
}
