@extends('dashboard.KaprodiLayout')

@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"
integrity="sha512-F5Ul1uuyFlGnIT1dk2c4kB4DBdi5wnBJjVhL7gQlGh46Xn0VhvD8kgxLtjdZ5YN83gybk/aASUAlpdoWUjRR3g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/kaprodi/kelas/edit.js') }}"></script>
@endsection

@section('content')
    <h1 class="mb-4 text-4xl font-bold" id="header" >Edit kelas {{$data->name}}</h1>

    {{-- table mahasiswa --}}
    <div class="mb-2 text-md font-medium text-gray-900">Daftar Mahasiswa</div>
    <div class="relative overflow-x-auto  border sm:rounded-lg mb-3">
        <table class="w-full table-auto border-collapse text-sm text-left rtl:text-right text-gray-700">
            <thead class="text-xs text-gray-300 border-b uppercase bg-gray-700">
                <tr>
                    <th class="p-3">
                        Nama
                    </th>
                    <th class="p-3">
                        NIM
                    </th>
                    <th class="p-3">
                        Tempat lahir
                    </th>
                    <th class="p-3">
                        Tanggal lahir
                    </th>
                    <th class="p-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $data_mahasiswa as $mhs )
                <tr class="bg-gray-100 ">
                    <th scope="row" class="p-3  font-medium text-gray-900">
                       {{$mhs->name}}
                    </th>
                    <td class="p-3 ">
                        {{$mhs->nim}}
                    <td class="p-3 ">
                        {{$mhs->tempat_lahir}}
                    </td>
                    <td class="p-3">
                        {{$mhs->tanggal_lahir}}
                    </td>
                    <td class="p-3 text-center">
                        <form action="{{ route('deleteMhsFromClass', $mhs->id) }}" method="post">
                            @csrf
                             @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <th colspan="5" class="text-center p-4">no data</th>
                    </tr>
                @endforelse
                    
            </tbody>
        </table>

    </div>
    {{-- end table mahasiswa --}}

    <form action="{{route('procces-update-kelas')}}" id="form-edit" method="POST" data-idKelas="{{$data->id}}">
        @csrf
        <div class="mb-6">
            <label for="nama_kelas" class="block mb-2 text-md font-medium text-gray-900">Nama Kelas - {{$data->name}}</label>
            <input type="text" id="nama_kelas" name="nama_kelas" class="w-full rounded-lg" placeholder="Masukkan nama kelas" value="{{old('nama_kelas',$data->name)}}" required />
            @error('nama_kelas')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-6">
            @if ($data->dosen)
            <label for="dosen_input" class="block mb-2 text-md font-medium text-gray-900">Dosen - {{ $data->dosen->name}} : {{ $data->dosen ->kode_dosen }}</label>
            <input type="text" id="dosen_input" name="dosen_input" data-value="{{$data->dosen->kode_dosen}} " class="w-full rounded-lg" placeholder="Masukkan Kode dosen"  value="{{$data->dosen->kode_dosen}}" required />
            @else
            <label for="dosen_input" class="block mb-2 text-md font-medium text-gray-900">Dosen - Tidak ada dosen</label>
            <input type="text" id="dosen_input" name="dosen_input" data-value="" class="w-full rounded-lg" placeholder="Masukkan Kode dosen"  value="" required />
                
            @endif
            @error('dosen_input')
            <small class="text-red-500">dosen tidak ditemukan</small>
            @enderror
            <div id="help-dosen">
                <div class="info"></div>
            </div>
        </div>
        <div class="mb-6">
            <label for="mahasiswa_input" class="block mb-2 text-sm font-medium text-gray-900">Mahasiswa</label>
            <input type="text" id="mahasiswa_input" name="mahasiswa_input" class="w-full rounded-lg" placeholder="Masukkan NIM Mahasiswa "   />
        </div>
        <div id="input_group">
            
        </div>
        <div class="text-right w-full">
            <button type="submit" class="button-green">Simpan</button>
        </div>
    </form>
@endsection

@section('header')
    <a href="{{ route('Kelaskaprodi') }}"><i class="fa-solid fa-arrow-left pe-2"></i>Kembali</a>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @else
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
    @endif
@endsection