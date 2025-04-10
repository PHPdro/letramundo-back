<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Testing\Fluent\Concerns\Has;

class Theme extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function words() : HasMany
    {
        return $this->hasMany(Word::class);
    }

    public function avatars() : HasMany
    {
        return $this->hasMany(Avatar::class);
    } 
}
