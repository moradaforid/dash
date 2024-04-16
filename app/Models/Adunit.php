<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adunit extends Model
{
    protected $table = 'adunits';

    use HasFactory;

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class, 'app_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(ReportAdunit::class, 'adunit_id');
    }
}
