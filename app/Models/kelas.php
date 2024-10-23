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

    protected $batasMaksimal = 3;

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
