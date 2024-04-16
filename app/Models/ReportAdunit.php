<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportAdunit extends Model
{
    use HasFactory;
    protected $table = 'report_adunits';


    public function adunit(): BelongsTo
    {
        return $this->belongsTo(Adunit::class, 'adunit_id');
    }
}
