<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Nama tabel yang benar di database

    protected $fillable = [
        'user_id',
        'kelas_id',
        'nim',
        'name',
        'tanggal_lahir',
        'tempat_lahir',
        'edit',
    ];

    public static function generateId()
    {
        $id = (int) (now()->format('y').rand(100, 999));

        return $id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function requestMhs()
    {
        return $this->hasOne(requestmodel::class);
    }
}
