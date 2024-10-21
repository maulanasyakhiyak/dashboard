<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\requestmodel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mhs = Auth::user();

        $data_mahasiswa = Mahasiswa::where('user_id', $mhs->id)->first();
        $hasrequest = requestmodel::where('mahasiswa_id',$mhs->id)->get();

        return view('dashboard.mahasiswa.dashboard', compact('data_mahasiswa' , 'hasrequest'));
    }

    public function requestEditMhs($id_mahasiswa){
        DB::beginTransaction();
        
        $kelas_id = Mahasiswa::find($id_mahasiswa)->kelas_id;

        if($kelas_id){
            try{
                requestmodel::create([
                    'id' => rand(1000,9999),
                    'kelas_id' => $kelas_id,
                    'mahasiswa_id' => $id_mahasiswa,
                    'keterangan' => 'process'
                ]);
                DB::commit();
                Alert::success('data berhasil ditambahkan');
                return redirect()->back();
                
            }catch(Exception $e){
                DB::rollBack();
                Alert::error($e->getMessage());
                return redirect()->back();
            }
        }else{
            Alert::error('Anda Belum Memiliki Kelas');
            return redirect()->back();
        }


        
    }
}
