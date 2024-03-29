<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applier extends Model
{
    use HasFactory;

    protected $fillable = ['tema', 'student'];

    public function user()
    {
        return $this->belongsTo(User::class, 'student');
    }

    
}