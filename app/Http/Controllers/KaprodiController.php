<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index(){
        return view('dashboard.kaprodi.dashboard');
    }
    public function kelas(){
        $data = kelas::paginate(10);
        return view('dashboard.kaprodi.kelas',compact('data'));
    }
    public function dosen(){
        return view('dashboard.kaprodi.dosen');
    }
    public function mahasiswa(){
        return view('dashboard.kaprodi.mahasiswa');
    }
    public function TambahKelas(){
        return view('dashboard.kaprodi.kelasComponent.TambahKelas');
    }
}
