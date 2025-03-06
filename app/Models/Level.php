<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    public function phases() : HasMany
    {
        return $this->hasMany(Phase::class);
    }
}
