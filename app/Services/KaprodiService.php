<?php

namespace App\Services;

use App\Models\Dosen;
use App\Models\kelas;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class KaprodiService
{
    public function updateJumlah($id)
    {
        $kelas = kelas::findOrFail($id);
        $kelas->jumlah = Mahasiswa::where('kelas_id', $id)->count() ?? 0;
        if ($kelas->CanAdd()) {
            $kelas->save();
        } else {
            throw new \Exception('Jumlah Mahasiswa melebihi batas');
        }
    }

    public function addClass($className, $kodeDosen)
    {
        DB::beginTransaction();
        try {
            $kelas_id = kelas::generateId();

            kelas::create([
                'id' => $kelas_id,
                'name' => $className,
                'jumlah' => 0,
            ]);
            Dosen::where('kode_dosen', $kodeDosen)->update([
                'kelas_id' => $kelas_id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

    }
}
