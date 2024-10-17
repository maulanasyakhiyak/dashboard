<?php

namespace App\Http\Controllers;

class DosenController extends Controller
{
    public function index()
    {
        return view('dashboard.dosen.dashboard');
    }
}
