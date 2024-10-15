@extends('dashboard.KaprodiLayout')

@section('header')
    <a href="{{ route('Kelaskaprodi') }}"><i class="fa-solid fa-arrow-left pe-2"></i>Kemb ali</a>
@endsection

@section('content')
    <div class="m-4">
        <h1 class="font-bold text-lg mb-6">Tambah Data Kelas</h1>
        <form action="">
            @csrf
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kelas</label>
                <input type="text" id="name" class="input-form" placeholder="Masukkan nama kelas" required />
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dosen</label>
                <input type="text" id="name" class="input-form" placeholder="Masukkan NIP dosen" required />
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mahasiswa</label>
                <input type="text" id="input-nim-mahasiswa" class="input-form" placeholder="Masukkan NIM Mahasiswa"
                    required />
            </div>
            <div class="relative overflow-x-auto border sm:rounded-lg mb-3">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                NIM
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
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


                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 ">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                a
                            </th>
                            <td class="px-6 py-4">
                                b
                            </td>
                            <td class="px-6 py-4">
                                c
                            </td>
                            <td class="px-6 py-4">
                                d
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"
        integrity="sha512-F5Ul1uuyFlGnIT1dk2c4kB4DBdi5wnBJjVhL7gQlGh46Xn0VhvD8kgxLtjdZ5YN83gybk/aASUAlpdoWUjRR3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/tambahKelas.js') }}"></script>
@endsection
