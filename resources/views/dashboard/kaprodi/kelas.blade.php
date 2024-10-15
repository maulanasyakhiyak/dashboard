@extends('dashboard.KaprodiLayout')

@section('content')


<div class="table-container">

    <div class="table-header mb-3">
        <h1>Data Kelas</h1>
        <a href="{{route('TambahKelasKaprodi')}}" class="button-green">+Tambah </a>
    </div>

    <div class="relative overflow-x-auto border sm:rounded-lg mb-3">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                       ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Nama Kelas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dosen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $dat )


                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$dat->id}}
                    </th>
                    <td class="px-6 py-4">
                        {{$dat->nama}}
                    </td>
                    <td class="px-6 py-4">
                        {{$dat->nim}}
                    </td>
                    <td class="px-6 py-4">
                        {{$dat->prodi}}
                    </td>
                    <td class="px-6 py-4">
                        {{$dat->email}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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

<script></script>

@endsection
