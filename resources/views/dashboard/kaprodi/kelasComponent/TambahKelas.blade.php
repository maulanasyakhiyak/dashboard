@extends('dashboard.KaprodiLayout')

@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"
        integrity="sha512-F5Ul1uuyFlGnIT1dk2c4kB4DBdi5wnBJjVhL7gQlGh46Xn0VhvD8kgxLtjdZ5YN83gybk/aASUAlpdoWUjRR3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('js/kaprodi/kelas/tambah.js') }}"></script>
@endsection

@section('header')
    <a href="{{ route('Kelaskaprodi') }}"><i class="fa-solid fa-arrow-left pe-2"></i>Kembali</a>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection

@section('content')
    <div class="m-4">
        <h1 class="font-bold text-lg mb-6">Tambah Data Kelas</h1>
        <form action="{{route('procces-tambah-kelas')}}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="nama_kelas" class="block mb-2 text-sm font-medium text-gray-900">Nama Kelas</label>
                <input type="text" id="nama_kelas" name="nama_kelas" class="input-form" placeholder="Masukkan nama kelas" value="{{old('nama_kelas')}}" required />
                @error('nama_kelas')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-6">
                <label for="dosen_input" class="block mb-2 text-sm font-medium text-gray-900">Dosen</label>
                <input type="text" id="dosen_input" name="dosen_input" class="input-form" placeholder="Masukkan Kode dosen" required />
                @error('dosen_input')
                <small class="text-red-500">dosen tidak ditemukan</small>
                @enderror
                <div id="help-dosen">
                    <div class="info"></div>
                </div>
            </div>
            <div class="text-right w-full">
                <button type="submit" class="button-green">Simpan</button>
            </div>
        </form>
    </div>
@endsection
