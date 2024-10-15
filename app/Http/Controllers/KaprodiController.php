<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index(){
        return view('dashboard.kaprodi.dashboard');
    }
    public function kelas(){
        return view('dashboard.kaprodi.kelas');
    }
    public function dosen(){
        return view('dashboard.kaprodi.dosen');
    }
    public function mahasiswa(){
        return view('dashboard.kaprodi.mahasiswa');
    }
}
