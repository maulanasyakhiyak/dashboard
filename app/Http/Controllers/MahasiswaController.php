<?php

namespace App\Http\Controllers;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('dashboard.mahasiswa.dashboard');
    }
}
