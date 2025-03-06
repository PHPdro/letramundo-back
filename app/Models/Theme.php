<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    public function words() : HasMany
    {
        return $this->hasMany(Word::class);
    }

    public function avatars() : HasMany
    {
        return $this->hasMany(Avatar::class);
    } 
}
