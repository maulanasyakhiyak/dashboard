<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\kelas;
use App\Models\Mahasiswa;
use App\Models\requestmodel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    private function updateJumlah($id)
    {
        $kelas = kelas::findOrFail($id);
        $kelas->jumlah = Mahasiswa::where('kelas_id', $id)->count() ?? 0;
        if ($kelas->CanAdd()) {
            $kelas->save();
        } else {
            throw new \Exception('Jumlah Mahasiswa melebihi batas');
        }
    }

    public function index()
    {
        $data = Dosen::with(['kelas'])
            ->where('user_id', Auth::id())
            ->first();
        $mhs = Mahasiswa::where('kelas_id', $data->kelas_id)->paginate(5);

        $req_mhs = RequestModel::with(['mahasiswa'])
            ->whereIn('mahasiswa_id', $mhs->pluck('id'))
            ->where('keterangan', 'process')
            ->get();

        return view('dashboard.dosen.dashboard', compact('data', 'mhs', 'req_mhs'));
    }

    public function emitMahasiswa($id)
    {
        DB::beginTransaction();
        $mhs = Mahasiswa::where('id', $id)->first();
        $kelas_id = $mhs->kelas_id;

        try {
            $mhs->update([
                'kelas_id' => null,
                'updated_at' => now(),
            ]);
            $this->updateJumlah($kelas_id);
            DB::commit();
            Alert::success('Hore!', 'Post Created Successfully');

            return redirect()->back()->with('success', `Mahasiswa telah di keluarkan`);
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function tambahMahasiswa(Request $r, $kelas_id)
    {
        $nim = $r->input('tambah_mahasiswa');
        DB::beginTransaction();

        try {
            Mahasiswa::where([
                'nim' => $nim,
            ])->update([
                'kelas_id' => $kelas_id,
            ]);
            $this->updateJumlah($kelas_id);
            DB::commit();
            Alert::success('Hore!', 'Post Created Successfully'.$kelas_id);

            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            Alert::error($e->getMessage());

            return redirect()->back();
        }
    }

    public function editMahasiswa($id)
    {
        $data = Mahasiswa::where('id', $id)->first();

        return view('dashboard.dosen.editMahasiswa', compact('data'));
    }

    public function editMahasiswaProcces(Request $r, $id)
    {

        $update_data = [];

        if ($r->has('name_mhs')) {
            $update_data['name'] = $r->input('name_mhs');
        }
        if ($r->has('tempat_lahir_mahasiswa')) {
            $update_data['tempat_lahir'] = $r->input('tempat_lahir_mahasiswa');
        }
        if ($r->has('tanggal_lahir_mahasiswa')) {
            $update_data['tanggal_lahir'] = $r->input('tanggal_lahir_mahasiswa');
        }

        $update_data['updated_at'] = now();

        try {
            DB::beginTransaction();
            Mahasiswa::where('id', $id)->update($update_data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 'error',
                'message' => "data gagal diperbaharui = {$e}",
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil diperbaharui',
            'redirect' => route('editMahasiswa', $id),
        ]);
    }

    public function accept_req($id)
    {

        requestmodel::findOrFail($id)->update([
            'keterangan' => 'accepted',
            'updated_at' => Carbon::now(),
        ]);

        Alert::success('berhasil '.$id);

        return redirect()->back();
    }

    public function reject_req($id)
    {
        requestmodel::findOrFail($id)->delete();
        Alert::error('berhasil '.$id);

        return redirect()->back();
    }
}
