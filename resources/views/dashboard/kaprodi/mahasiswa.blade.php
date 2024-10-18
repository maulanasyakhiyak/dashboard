@extends('dashboard.KaprodiLayout')

@section('header')

<p class="text-2xl bold">Hallo {{ Auth::user()->name }} , Anda adalah {{ Auth::user()->role }}</p>

@endsection


@section('content')

<h1>Data Mahasiswa</h1>
<div class="relative overflow-x-auto border sm:rounded-lg mb-3">
    <table class="w-full text-sm text-left rtl:text-right text-gray-700">
        <thead class="text-xs text-gray-300 border-b uppercase bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3">
                    no
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    NIM
                </th>
                <th scope="col" class="px-6 py-3">
                    Kelas
                </th>
                <th scope="col" class="px-6 py-3">
                    Tempat Lahir
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal Lahir
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $dat)
                <tr class="bg-gray-100 ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $dat->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $dat->nim }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $dat->kelas->name ?? 'belum ada kelas' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $dat->tempat_lahir }}
                    </td>
                    <td class="px-6 py-4 ">
                        {{ $dat->tanggal_lahir }}
                    </td>
                </tr>

            @empty
                <td class="px-6 py-4 text-center" colspan="5">
                    <a href="#" class="font-medium text-center">No data</a>
                </td>
            @endforelse
        </tbody>
    </table>

</div>

{{ $data->links() }}

@endsection
