<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'identitas_id'];

    protected $hidden = ['password', 'remember_token'];

    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    public function isMahasiswa(): bool {
        return $this->role === 'mahasiswa';
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'identitas_id', 'npm');
    }
}