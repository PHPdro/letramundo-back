<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Word extends Model
{
     public function themes() : BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }
}

   
