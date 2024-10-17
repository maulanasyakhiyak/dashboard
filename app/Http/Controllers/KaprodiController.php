<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaprodiController extends Controller
{
    public function index()
    {
        return view('dashboard.kaprodi.dashboard');
    }

    public function kelas()
    {
        $data = kelas::with('dosen')->paginate(5);

        return view('dashboard.kaprodi.kelas', compact('data'));
    }

    public function dosen()
    {
        $data = Dosen::paginate(5);

        return view('dashboard.kaprodi.dosen', compact('data'));
    }

    public function mahasiswa()
    {
        return view('dashboard.kaprodi.mahasiswa');
    }

    public function TambahKelas()
    {
        return view('dashboard.kaprodi.kelasComponent.TambahKelas');
    }

    public function editKelas($id)
    {
        $data = kelas::with('dosen')->findOrFail($id);
        $data_mahasiswa =  Mahasiswa::where('kelas_id' , '=', $id)->paginate(5);

        return view('dashboard.kaprodi.kelasComponent.editKelas', compact('data','data_mahasiswa'));
    }

    public function search(Request $request)
    {
        $query = $request->get('term');
        $kode_dosen = $request->get('kode_dosen');
        $idMhs = $request->get('except', []);

        switch($request->get('from')){
            
            case 'edit_kelas':
                $results = dosen::where('kode_dosen', 'like', '%'.$query.'%')
                ->whereDoesntHave('kelas')
                ->where('kode_dosen', '!=', $kode_dosen)
                ->get();

                break;

            case 'edit_kelas-mahasiswa':

                $mahasiswaQuery = Mahasiswa::where('nim', 'like', '%'.$query.'%')
                ->whereDoesntHave('kelas');

                if (! empty($idMhs)) {
                    $mahasiswaQuery->whereNotIn('id', $idMhs);
                }

                $results = $mahasiswaQuery->get();
                break;

            default:
            $results = dosen::where('kode_dosen', 'like', '%'.$query.'%')
            ->whereDoesntHave('kelas')
            ->get();
        }

        return response()->json($results);
    }

    public function proccesTambahKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|min:3',
            'dosen_input' => 'required|exists:dosen,kode_dosen',
        ]);

        $id = rand(100000, 999999);
        $kelas = new kelas;
        $kelas->id = $id;
        $kelas->name = $request->nama_kelas;
        $kelas->jumlah = 0;
        $kelas->save();

        $dosen = Dosen::where('kode_dosen', $request->dosen_input)->first();
        $dosen->kelas_id = $id;
        $dosen->save();

        return redirect()->back()->with('success', 'berhasil tambah data');
    }

    private function updateJumlah($id){
        $jumlahmhs = Mahasiswa::where('kelas_id', '=', $id)->count();
        $kelas = kelas::findOrFail($id);
        $kelas->jumlah = $jumlahmhs;
        $kelas->save();
    }

    public function proccesUpdateKelas(Request $request)
    {
        $newclass = $request->input('newclass');
        $newDosen = $request->input('newDosen');
        $oldDosen = $request->input('oldDosen');
        $idkelas = $request->input('idKelas');
        $idmhs = $request->input('newMhs');
    
        DB::beginTransaction(); 
        try {
            Kelas::where('id', $idkelas)->update([
                'name' => $newclass,
                'updated_at' => now()
            ]);
    
            if (Dosen::where('kode_dosen', $newDosen)->first()) {
                
                Dosen::where('kode_dosen', $oldDosen)->update([
                    'kelas_id' => null,
                    'updated_at' => now()
                ]);
                
                Dosen::where('kode_dosen', $newDosen)->update([
                    'kelas_id' => $idkelas,
                    'updated_at' => now()
                ]);
            } else {
                DB::rollback(); 
                return response()->json([
                    'status' => 'error',
                    'message' => 'Dosen not found'
                ]);
            }
    
            
            if (!empty($idmhs)) {
                foreach ($idmhs as $id) {
                    Mahasiswa::where('id', $id)->update(['kelas_id' => $idkelas]);
                }
                $this->updateJumlah($idkelas);
                
                DB::commit(); 
                return response()->json([
                    'status' => 'success',
                    'message' => 'Mahasiswa berhasil ditambahkan',
                ]);
            } else {
                DB::commit(); 
                return response()->json([
                    'status' => 'success',
                    'message' => 'Tidak ada ID mahasiswa yang diberikan.',
                ]);
            }
    
        } catch (\Exception $e) {
            DB::rollback(); 
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan kelas ke mahasiswa: ' . $e->getMessage(),
            ], 500);
        }
    }
    
}
