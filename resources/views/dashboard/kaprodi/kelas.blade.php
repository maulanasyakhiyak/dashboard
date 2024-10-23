@extends('dashboard.KaprodiLayout')

@section('header')
    <p class="text-2xl bold">Hallo {{ Auth::user()->name }} , Anda adalah {{ Auth::user()->role }}</p>
@endsection

@section('content')
    <div class="table-container">

        <div class="table-header mb-3">
            <h1>Data Kelas</h1>
            <a href="{{ route('TambahKelasKaprodi') }}" class="button-green">+ Tambah </a>
        </div>

        <div class="relative overflow-x-auto  border sm:rounded-lg mb-3">
            <table class="w-full table-auto border-collapse text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-gray-300 border-b uppercase bg-gray-700">
                    <tr>
                        <th class="p-3">
                            ID
                        </th>
                        <th class="p-3">
                            Nama Kelas
                        </th>
                        <th class="p-3">
                            Dosen
                        </th>
                        <th class="p-3 text-center">
                            Jumlah
                        </th>
                        <th class="p-3 w-auto text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $dat)
                        <tr class="bg-gray-100 ">
                            <th scope="row" class="p-3  font-medium text-gray-900">
                                {{ $dat->id }}
                            </th>
                            <td class="p-3 ">
                                {{ $dat->name }}
                            </td>
                            <td class="p-3 ">
                                {{ $dat->dosen->name ?? 'null' }}
                            </td>
                            <td class="p-3 text-center">
                                {{$dat->jumlah}} / {{ $dat->MaxClass() }}
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('editKelasKaprodi', $dat->id) }}" class="p-2"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('procces-delete-kelas', $dat->id) }}" method="post" class="inline p-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');"><i class="fa-solid fa-trash"></i></button>
                                </form>
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
        <div class="pagination">
            {{ $data->links() }}
        </div>

    </div>
@endsection
