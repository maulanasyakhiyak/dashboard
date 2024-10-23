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
        <form action="{{ route('requestEditMhs', $data_mahasiswa->id) }}" method="POST" class="inline">
            @csrf
            @if ($hasrequest)
                <button type="submit" class="button-green" disabled>Request Edit Data</button>
                @switch($hasrequest->keterangan)
                    @case('process')
                        <small class="text-red-500 ps-2">Request edit data sedang dalam process</small>
                    @break
                @endswitch
            @else
                <button type="submit" class="button-green">Request Edit Data</button>
            @endif
        </form>

        @if ($hasrequest && $hasrequest->keterangan == 'accepted')
            <div class="bg-emerald-300 text-white px-4 py-2 rounded mt-4">
                <i class="fa-solid fa-circle-info pe-2"></i>
                Request anda diterima ganti data anda <a href="{{ route('mahasiswa.editMahasiswa') }}" class="font-bold underline">disini</a>
            </div>
        @endif
    </div>
@endsection
