<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Services\KaprodiService;
use Faker\Factory as faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KaprodiController extends Controller
{
    protected $KaprodiService;

    public function __construct(KaprodiService $KaprodiService)
    {
        $this->KaprodiService = $KaprodiService;
    }

    // PUBLIC FUNCTION
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
        $data = Mahasiswa::with('kelas')->paginate(5);

        return view('dashboard.kaprodi.mahasiswa', compact('data'));
    }

    public function TambahKelas()
    {
        return view('dashboard.kaprodi.kelasComponent.TambahKelas');
    }

    public function editKelas($id)
    {
        $data = kelas::with('dosen')->findOrFail($id);
        $data_mahasiswa = Mahasiswa::where('kelas_id', '=', $id)->paginate(5);

        return view('dashboard.kaprodi.kelasComponent.editKelas', compact('data', 'data_mahasiswa'));
    }

    public function search(Request $request)
    {
        $query = $request->get('term');
        $kode_dosen = $request->get('kode_dosen');
        $idMhs = $request->get('except', []);

        switch ($request->get('from')) {

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
        $data = $request->validate([
            'nama_kelas' => 'required|min:3',
            'dosen_input' => 'required|exists:dosen,kode_dosen',
        ]);

        $this->KaprodiService->addClass(
            $data['nama_kelas'],
            $data['dosen_input']
        );

        Alert::success('Hore!', 'Post Created Successfully');

        return redirect()->back()->with('success', 'berhasil tambah data');
    }

    public function proccesUpdateKelas(Request $request)
    {
        $newclass = $request->input('newclass');
        $newDosen = $request->input('newDosen');
        $oldDosen = $request->input('oldDosen');
        $idkelas = $request->input('idKelas');
        $idmhs = $request->input('newMhs');

        $data = $request->validate([
            'newclass' => 'required|min:3',
            'newDosen' => 'required|exists:dosen,kode_dosen',
        ]);

        DB::beginTransaction();
        try {
            Kelas::where('id', $idkelas)->update([
                'name' => $newclass,
                'updated_at' => now(),
            ]);

            $dosenBaru = Dosen::where('kode_dosen', $newDosen)->first();

            // Jika dosen baru tidak ditemukan
            if ($dosenBaru !== $oldDosen) {

                Dosen::where('kode_dosen', $oldDosen)->update([
                    'kelas_id' => null,
                    'updated_at' => now(),
                ]);

                Dosen::where('kode_dosen', $newDosen)->update([
                    'kelas_id' => $idkelas,
                    'updated_at' => now(),
                ]);
            }

            if (! empty($idmhs)) {
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
                'message' => 'Terjadi kesalahan saat menambahkan kelas ke mahasiswa: '.$e->getMessage(),
            ]);
        }
    }

    public function proccesDeleteKelas($id)
    {
        $item = kelas::findOrFail($id); // Temukan item berdasarkan ID

        try {
            $item->delete(); // Hapus item

            return redirect()->back()->with('success', 'Item berhasil dihapus.'); // Kembali dengan pesan sukses
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus item: '.$e->getMessage());
        }
    }

    public function deleteMhsFromClass($id)
    {
        DB::beginTransaction();
        try {
            $mhs = Mahasiswa::where('id', $id)->first();
            $kelas_id = $mhs->kelas_id;

            $mhs->update([
                'kelas_id' => null,
                'updated_at' => now(),
            ]);

            $this->KaprodiService->updateJumlah($kelas_id);

            DB::commit();
            Alert::success('item berhasil dihapus');

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus item: '.$e->getMessage());
        }
    }

    // DOSEN

    public function edit_dosen(Request $request, $kode_dosen)
    {
        $data = $request->input('name');
        DB::beginTransaction();
        try {
            Dosen::where('kode_dosen', $kode_dosen)->update([
                'name' => $data,
                'updated_at' => now(),
            ]);
            DB::commit();
            Alert::success('Hore!', 'Post Created Successfully');

            return redirect()->back()->with('success', 'berhasil update'.$data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ' error pada update data '.$e);
        }

    }

    public function delete_dosen($id)
    {
        DB::beginTransaction();

        try {
            $dosen = Dosen::find($id);

            User::destroy($dosen->user_id);

            $dosen->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', ' error pada delete data '.$e);

        }

        return redirect()->back()->with('success', 'telah sampai controller dengan id = '.$id);
    }

    public function tambah_dosen(Request $req)
    {
        $faker = faker::create();

        $req->validate(([
            'email_input' => 'required|email',
        ]));
        $newDosen = $req->input('new_name');
        $email = $req->input('email_input');

        DB::beginTransaction();
        try {
            $user_id = $faker->unique()->numberBetween(1000, 9999);

            User::create([
                'id' => $user_id,
                'name' => $newDosen,
                'email' => $email,
                'password' => bcrypt('password'),
                'role' => 'dosen',
            ]);

            Dosen::create([
                'id' => rand(1000, 9999),
                'user_id' => $user_id,
                'kode_dosen' => $faker->unique()->numerify('DOS######'),
                'nip' => $faker->unique()->numerify('######'),
                'name' => $newDosen,

            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', ' error pada delete data '.$e);

        }

        return redirect()->back()->with('success', 'data dibuat contrroler ='.$newDosen.':'.$email);
    }
}
