<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{

    protected $fillable = [
        'name',
        'age',
        'year',
        'class',
        'user_id',
        'theme_id',
    ];

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class);
    } 
}
