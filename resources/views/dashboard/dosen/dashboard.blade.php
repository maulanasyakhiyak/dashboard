@extends('dashboard.DosenLayout')

@section('content')
    @if ($data->kelas == null)
        Tidak ada kelas
    @else
        <div class="w-full flex justify-between items-center mb-3 mt-1">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Data Kelas</h3>
                <p class="text-slate-500">{{$data->kelas->name}}</p>
            </div>
            <div class="ml-3 flex gap-2">
                <a href="" class="bg-green-400 py-3 px-4 text-white shadow rounded-md">+ Masukan Mahasiswa Baru</a>
                <a href="" class="bg-blue-400 w-12 h-12 text-white shadow rounded-full flex items-center justify-center relative">
                    <i class="fa-regular fa-bell"></i>
                    <span class="absolute text-red-400 top-3 right-4 transform translate-x-1/2 -translate-y-1/2 font-bold text-xs">2</span>
                </a>    
            </div>
            
        </div>

        <div class="relative flex flex-col w-full h-full overflow-hidden text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 ps-6 border-b border-slate-200 bg-slate-200">
                            <p class="text-sm font-medium leading-none text-slate-700 ">
                                No
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-200">
                            <p class="text-sm font-medium leading-none text-slate-700">
                                Nama
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-200">
                            <p class="text-sm font-medium leading-none text-slate-700">
                                NIM
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-200">
                            <p class="text-sm font-medium leading-none text-slate-700">
                                Tempat Lahir
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-200">
                            <p class="text-sm font-medium leading-none text-slate-700">
                                Tanggal Lahir
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-200 pe-6 w-44">
                            <p class="text-sm font-medium leading-none text-slate-700">
                                Action
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mhs as $key => $item)
                        <tr class="hover:bg-slate-50 border-b border-slate-200">
                            <td class="p-4 ps-6 py-5">
                                <p class="block font-semibold text-sm text-slate-800">{{ $mhs->firstItem() + $key }}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-500">{{ $item->name }}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-500">{{ $item->nim }}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-500">{{ $item->tempat_lahir }}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-500">{{ $item->tanggal_lahir }}</p>
                            </td>
                            <td class="p-4 py-5 pe-6 flex gap-4">
                                <form action="" class="inline">
                                    <button class="text-red-500">Keluarkan</button>
                                </form>
                                <form action="" class="inline">
                                    <button class="text-slate-500">Edit</button>
                                </form>
                                </div>
                            </td>
                        </tr>

                    @empty
                    @endforelse
                </tbody>
            </table>
            <div class="px-4 py-3">
                {{ $mhs->links() }}
            </div>
        </div>
    @endif
@endsection
