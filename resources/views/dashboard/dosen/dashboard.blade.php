@extends('dashboard.DosenLayout')

@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"
        integrity="sha512-F5Ul1uuyFlGnIT1dk2c4kB4DBdi5wnBJjVhL7gQlGh46Xn0VhvD8kgxLtjdZ5YN83gybk/aASUAlpdoWUjRR3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('js/dosen/dosen.js') }}"></script>
@endsection

@section('header')
    <p class="text-base bold">Hallo {{ Auth::user()->name }} , Anda adalah {{ Auth::user()->role }} </p>



    <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
        class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400"
        type="button">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
            <path
                d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
        </svg>
        @if (count($req_mhs) > 0) 
        <div
            class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 dark:border-gray-900">
        </div>
        @endif
    </button>

    <!-- Dropdown menu -->
    <div id="dropdownNotification"
        class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
        aria-labelledby="dropdownNotificationButton">
        <div
            class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
            Notifications
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            @forelse ($req_mhs as $item)

            <div class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                <div class="w-full">
                    <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400"><span class="font-bold">{{$item->mahasiswa->name}}</span> Meminta Edit Data</div>
                    <div class="grid grid-cols-2 gap-2 mb-1.5">
                        <form action="{{ route('accept_req',$item->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="button-green w-full p-2">Accept</button>
                        </form>
                        <form action="{{ route('reject_req',$item->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="button-red  w-full p-2">Reject</button>
                        </form> 
                    </div>
                    <div class="text-xs text-blue-600 dark:text-blue-500">{{$item->created_at->diffForHumans()}}</div>
                </div>
            </div>

                @empty
                    
                @endforelse
        </div>
        <a href=""
            class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
            <div class="inline-flex items-center ">
                <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                    <path
                        d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                </svg>
                View all
            </div>
        </a>
    </div>
@endsection

@section('content')
    @if ($data->kelas == null)
        Tidak ada kelas
    @else
        <div class="w-full flex justify-between items-center mb-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Data Kelas</h3>
                <p class="text-slate-500">{{ $data->kelas->name }}</p>
            </div>
            <div class="ml-3 flex gap-2">
                <button data-modal-target="addnewmahasiswaclass" data-modal-toggle="addnewmahasiswaclass"
                    class="bg-green-400 py-3 px-4 text-white text-sm  shadow rounded-md">+ Masukan Mahasiswa
                    Baru</button>
                <!-- Main modal -->
                <div id="addnewmahasiswaclass" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between px-4 py-2 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Tambah Mahasiswa ke kelas {{ $data->kelas->name }}
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="addnewmahasiswaclass">
                                    <i class="fa-solid fa-x"></i>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form class="p-4" action="{{ route('tambahMahasiswa', $data->kelas->id) }}" method="POST">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="tambah_mahasiswa"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="tambah_mahasiswa" id="tambah_mahasiswa"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Masukkan nim mahasiswa" required>
                                    </div>
                                </div>
                                <button type="submit" class="button-blue">
                                    Tambah Mahasiswa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- END MODAL --}}
            </div>
        </div>


        <table class="w-full text-left table-auto min-w-max bg-white rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="p-4 ps-6 border-b border-slate-100 bg-blue-100">
                        <p class="text-sm font-medium leading-none text-slate-700 ">
                            No
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-100 bg-blue-100">
                        <p class="text-sm font-medium leading-none text-slate-700">
                            Nama
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-100 bg-blue-100">
                        <p class="text-sm font-medium leading-none text-slate-700">
                            NIM
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-100 bg-blue-100">
                        <p class="text-sm font-medium leading-none text-slate-700">
                            Tempat Lahir
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-100 bg-blue-100">
                        <p class="text-sm font-medium leading-none text-slate-700">
                            Tanggal Lahir
                        </p>
                    </th>
                    <th class="p-4 border-b border-slate-100 bg-blue-100 pe-6 w-44">
                        <p class="text-sm font-medium leading-none text-slate-700">
                            Action
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mhs as $key => $item)
                    <tr class="hover:bg-blue-50 border-b border-slate-200">
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
                            <form action="{{ route('emitMahasiswa', $item->id) }}" method="POST"
                                class="inline keluar_form" id="">
                                @csrf
                                <button class="text-red-500">Keluarkan</button>
                            </form>
                            <form action="{{ route('editMahasiswa', $item->id) }}" class="inline">
                                @csrf
                                <button class="text-slate-500">Edit</button>
                            </form>

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
