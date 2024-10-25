<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'id',
        'name',
        'jumlah',
    ];

    protected $batasMaksimal = 10;

    public static function generateId()
    {
        $id = (int) (now()->format('dmy').rand(10, 99));

        return $id;
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function requestKelas()
    {
        return $this->hasMany(requestmodel::class);
    }

    public function CanAdd()
    {
        return $this->jumlah <= $this->batasMaksimal;
    }

    public function MaxClass()
    {
        return $this->batasMaksimal;
    }
}
