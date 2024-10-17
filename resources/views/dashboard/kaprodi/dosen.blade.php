@extends('dashboard.KaprodiLayout')

@section('header')
    <p class="text-2xl bold">Hallo {{ Auth::user()->name }} , Anda adalah {{ Auth::user()->role }}</p>
@endsection

@section('content')
    <div class="table-container">

        <div class="table-header mb-3">
            <h1>Data Dosen</h1>
            <a href="{{ route('TambahKelasKaprodi') }}" class="button-green">+Tambah </a>
        </div>

        <div class="relative overflow-x-auto border sm:rounded-lg mb-3">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-gray-300 border-b uppercase bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NIP
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kode Dosen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kelas Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                           action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $dat)
                        <tr class="bg-gray-100 ">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $dat->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $dat->nip }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $dat->kode_dosen }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $dat->kelas_id }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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

    </div>
@endsection
