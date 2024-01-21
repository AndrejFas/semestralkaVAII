<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function file()
    {
        return $this->hasOne(File::class, 'student_id');
    }

    public function appliers()
    {
        return $this->hasMany(Applier::class, 'student');
    }

    public function job()
    {
        return $this->hasOne(Job::class, 'student');
    }

    protected $table = 'users';

    protected $fillable = [
        'first_name', 'last_name', 'username', 'password', 'user_type',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }
}