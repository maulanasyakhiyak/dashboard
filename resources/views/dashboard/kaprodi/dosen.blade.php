@extends('dashboard.KaprodiLayout')

@section('js')
    <script src="{{ asset('js/kaprodi/dosen/dosen.js') }}"></script>
@endsection

@section('header')
    <p class="text-2xl bold">Hallo {{ Auth::user()->name }} , Anda adalah {{ Auth::user()->role }}</p>
    <p>{{ session('success')}}</p>
@endsection

@section('content')
    <div class="table-container">

        <div class="table-header mb-3">
            <h1>Data Dosen</h1>
            <button data-modal-target="crud-modal-tambah_dosen" data-modal-toggle="crud-modal-tambah_dosen"  class="button-green">+ Tambah </button>
            <!-- Main modal -->
            <div id="crud-modal-tambah_dosen" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between px-4 py-2 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Tambah Dosen
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="crud-modal-tambah_dosen">
                                <i class="fa-solid fa-x"></i>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4" action="{{ route('tambah_dosen') }}" method="POST">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" name="new_name" id="new_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Masukkan nama"  required>
                                </div>
                            </div>
                            <button type="submit"
                                class="button-blue">
                               
                                Add new product
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- END MODAL --}}
            
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
                        <th scope="col" class="px-6 py-3 text-center">
                            action
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
                                {{ $dat->nip }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $dat->kode_dosen }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $dat->kelas_id }}
                            </td>
                            <td class="px-6 py-4 ">

                                <div class="w-full text-center">
                                    <!-- Modal toggle -->
                                    <button data-modal-target="crud-modal-{{$dat->id}}" data-modal-toggle="crud-modal-{{$dat->id}}" class="text-blue-600 px-2 text-center inline hover:text-blue-400" type="button">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>

                                    <form action="{{ route('delete_dosen', $dat->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class=" px-2" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');"><i class="fa-solid fa-trash"></i></button>
                                    </form>
    
                                </div>


                                <!-- Main modal -->
                                <div id="crud-modal-{{$dat->id}}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between px-4 py-2 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Edit Dosen
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="crud-modal-{{$dat->id}}">
                                                    <i class="fa-solid fa-x"></i>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form class="p-4" action="{{ route('edit_dosen',$dat->kode_dosen) }}" method="POST">
                                                @csrf
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                        <input type="text" name="name" id="name"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Masukkan nama" value="{{ $dat->name }}" required>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="button-blue">
                                                   
                                                    Add new product
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>


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
