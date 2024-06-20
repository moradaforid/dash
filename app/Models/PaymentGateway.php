<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentGateway extends Model
{
    protected $table = 'payment_gateways';

    use HasFactory;

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class, 'service_provider_id');
    }
}
