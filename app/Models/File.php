<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'pdf_text', 'zip_prilohy', 'pdf_originalita'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}