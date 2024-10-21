@extends('dashboard.MahasiswaLayout')

@section('content')
    <div class="w-3/4">
        <div class="grid grid-cols-2 gap-3 mb-3">
            <div class="">
                <label for="" class="block mb-2">Name</label>
                <div class=" shadow p-3 rounded bg-gray-50 text-gray-900 text-sm">{{ $data_mahasiswa->name }}</div>
            </div>
            <div class="">
                <label for="" class="block mb-2">Tempat Lahir</label>
                <div class=" shadow p-3 rounded bg-gray-50 text-gray-900 text-sm">{{ $data_mahasiswa->tempat_lahir }}</div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3 mb-6">
            <div class="">
                <label for="" class="block mb-2">Tanggal Lahir</label>
                <div class=" shadow p-3 rounded bg-gray-50 text-gray-900 text-sm">{{ $data_mahasiswa->tanggal_lahir }}</div>
            </div>
        </div>
        <form action="{{ route('requestEditMhs',$data_mahasiswa->id) }}" method="POST" class="inline">
            @csrf
                <button type="submit" class="button-green">Request Edit Data</button>
        </form>

    </div>
    
@endsection
