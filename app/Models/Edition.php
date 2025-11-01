<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Edition extends Model
{
    protected $fillable = [
        'name',
    ];

    public function races(): HasMany
    {
        return $this->hasMany(Race::class);
    }

    public function abilities(): HasMany
    {
        return $this->hasMany(Ability::class);
    }
}
