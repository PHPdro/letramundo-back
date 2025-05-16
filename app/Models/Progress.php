<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Progress extends Model
{
    protected $fillable = [
        'student_id',
        'phase_id',
    ];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
