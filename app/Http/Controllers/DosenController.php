<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function index()
    {
        $dosen_id = Auth::user()->id;
        
        $data = Dosen::with(['kelas'])
        ->where('user_id', $dosen_id)
        ->first();

        $mhs = Mahasiswa::where('kelas_id',$data->kelas_id)->paginate(5);

        // dd($data);
        return view('dashboard.dosen.dashboard',compact('data','mhs'));
    }
}
