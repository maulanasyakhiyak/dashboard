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
        'edit'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
