<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['nazov', 'veduci', 'tutor', 'student', 'popis', 'cas', 'katedra', 'odbor', 'jazyk', 'stupen', 'stav'];

    

    public function job()
    {
        return $this->belongsTo(User::class, 'tema');
    }
}
