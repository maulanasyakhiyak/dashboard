@extends('dashboard.MahasiswaLayout')

@section('js')

@endsection

@section('header')
<a href="{{ route('DashboardMahasiswa') }}"><i class="fa-solid fa-arrow-left pe-2"></i>Kembali</a>
@endsection

@section('content')
<div class="max-w-lg">
    <h3 class="text-lg font-semibold text-slate-800 mb-4">Edit Mahasiswa</h3>

    <form action="{{ route('mahasiswa.editMahasiswaProcces', $data->id) }}" method="POST" class="form_edt_mhs">
        @csrf
        <div class="col-span-2 mb-3">
            <label for="name_edt_mhs"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" name="name_edt_mhs" id="name_edt_mhs"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Masukkan nama baru mahasiswa" value="{{$data->name}}" required>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-3">
            <div class="">
                <label for="tmpt_lhr_edt_mhs"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Lahir</label>
            <input type="text" name="tmpt_lhr_edt_mhs" id="tmpt_lhr_edt_mhs"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Masukkan nim mahasiswa" value="{{$data->tempat_lahir}}" required>
            </div>
            <div class="">
                <label for="tgl_lhr_edt_mhs"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
            <input type="date" name="tgl_lhr_edt_mhs" id="tgl_lhr_edt_mhs"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Masukkan nim mahasiswa" value="{{$data->tanggal_lahir}}" required>
            </div>
        </div>

        <div class="w-full text-right">
            <button type="submit" class="button-green w-32">Simpan</button>
        </div>
    </form>
</div>
@endsection