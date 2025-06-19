<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phase extends Model
{

    protected $fillable = [
        'phase',
        'level_id',
    ];
    
    public function level () : BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
}
