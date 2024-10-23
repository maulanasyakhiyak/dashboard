<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role', // Tambahkan 'status' jika perlu
    ];

    // Kolom yang disembunyikan
    protected $hidden = [
        'password',
    ];

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }
}
