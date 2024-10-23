<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\requestmodel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mhs = Auth::user();

        $data_mahasiswa = Mahasiswa::where('user_id', $mhs->id)->first();
        $hasrequest = requestmodel::where('mahasiswa_id', $data_mahasiswa->id)->first();

        return view('dashboard.mahasiswa.dashboard', compact('data_mahasiswa', 'hasrequest'));
    }

    public function editMahasiswa()
    {

        $id_mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail()->id;
        $req = requestmodel::where('mahasiswa_id', $id_mahasiswa)
            ->where('keterangan', 'accepted')
            ->exists();
        if ($req) {
            $data = Mahasiswa::findOrFail($id_mahasiswa);

            return view('dashboard.mahasiswa.editMahasiswa', compact('data'));
        } else {
            return redirect()->back();
        }
    }

    public function requestEditMhs($id_mahasiswa)
    {
        DB::beginTransaction();

        $current_time = Carbon::now();

        $mhs = Mahasiswa::find($id_mahasiswa);

        if ($mhs->kelas_id) {

            if ($mhs->requestMhs()->exists()) {
                Alert::error('sudah ada request');

                return redirect()->back();
            } else {
                try {
                    requestmodel::create([
                        'id' => rand(1000, 9999),
                        'kelas_id' => $mhs->kelas_id,
                        'mahasiswa_id' => $id_mahasiswa,
                        'keterangan' => 'process',
                        'created_at' => $current_time,
                        'updated_at' => $current_time,
                    ]);
                    DB::commit();
                    Alert::success('data berhasil ditambahkan');

                    return redirect()->back();
                } catch (Exception $e) {
                    DB::rollBack();
                    Alert::error($e->getMessage());

                    return redirect()->back();
                }
            }
        } else {
            Alert::error('Anda Belum Memiliki Kelas');

            return redirect()->back();
        }

    }

    public function editMahasiswaProcces(Request $r)
    {
        $id_mahasiswa = Mahasiswa::where('user_id', Auth::id())->first()->id;
        DB::beginTransaction();
        try {
            Mahasiswa::findOrFail($id_mahasiswa)->update([
                'name' => $r->input('name_edt_mhs'),
                'tempat_lahir' => $r->input('tmpt_lhr_edt_mhs'),
                'tanggal_lahir' => $r->input('tgl_lhr_edt_mhs'),
                'updated_at' => Carbon::now(),
            ]);

            requestmodel::where('mahasiswa_id', $id_mahasiswa)->delete();

            DB::commit();
            Alert::success('Data Berhasil Diubah');

            return redirect()->route('DashboardMahasiswa');
            // diatas adalah nama

        } catch (Exception $e) {
            DB::rollBack();
            Alert::error($e->getMessage());

            return redirect()->back();
        }
    }
}
