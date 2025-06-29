<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'name',
        'year',
        'class',
        'user_id',
        'theme_id',
    ];

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function theme() : BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function progress() : BelongsTo
    {
        return $this->belongsTo(Progress::class);
    }
}
