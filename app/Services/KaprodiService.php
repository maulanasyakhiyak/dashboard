<?php

namespace App\Services;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class KaprodiService
{
    /**
     * Update the number of students in a class.
     *
     * @param int $id The ID of the class.
     * @throws \Exception If the number of students exceeds the limit.
     */
    public function updateJumlah($id)
    {
        // Find the class by ID or fail if not found
        $kelas = Kelas::findOrFail($id);

        // Update the class with the new student count
        $kelas->jumlah =Mahasiswa::where('kelas_id', $id)->count();

        // Check if the class can accommodate more students
        if ($kelas->canAdd()) {
            $kelas->save();
        } else {
            throw new \Exception('Jumlah Mahasiswa melebihi batas');
        }
    }

    /**
     * Add a new class.
     *
     * @param string $className The name of the class.
     * @param string $kodeDosen The code of the lecturer.
     * @throws \Exception If an error occurs during class creation.
     */
    public function addClass($className, $kodeDosen)
    {
        DB::beginTransaction();
        try {
            // Generate a new class ID
            $kelas_id = Kelas::generateId();

            // Create a new class instance
            $kelas = new Kelas();
            $kelas->id = $kelas_id;
            $kelas->name = $className;
            $kelas->dosen_kode = $kodeDosen;
            $kelas->jumlah = 0; // Initialize with zero students

            // Save the new class
            $kelas->save();

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            throw new \Exception('Error while adding class: ' . $e->getMessage());
        }
    }
}