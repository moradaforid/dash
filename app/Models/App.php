<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;



class App extends Model
{
    use HasFactory;

    //use Multitenantable;

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function adunits(): hasMany
    {
        return $this->hasMany(Adunit::class, 'app_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'app_has_categories', 'app_id', 'category_id');
    }
}
