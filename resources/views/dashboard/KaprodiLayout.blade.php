<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'public/css/layout.css', 'public/css/kaprodi.css'])
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/solid.css') }}">
    @yield('css')
    <title>Dashboard</title>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-title">
            <h2>DASHBOARD ADMIN</h2>
        </div>
        <ul class="sidebar-warp">
            <li class="sidebar-item {{ request()->routeIs('Dashboardkaprodi') ? 'active' : '' }}">
                <a href="{{ route('Dashboardkaprodi') }}"><i class="fa-solid fa-gauge pe-4"></i>Dashboard</a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('Kelaskaprodi') ? 'active' : '' }}">
                <a href="{{ route('Kelaskaprodi') }}"><i class="fa-solid fa-book pe-4"></i></i>Kelas</a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('Dosenkaprodi') ? 'active' : '' }}">
                <a href="{{ route('Dosenkaprodi') }}"><i class="fa-solid fa-chalkboard-user pe-4"></i>Dosen</a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('Mahasiswakaprodi') ? 'active' : '' }}">
                <a href="{{ route('Mahasiswakaprodi') }}"><i class="fa-solid fa-user pe-4"></i>Mahasiswa</a>
            </li>
        </ul>
    </div>

    <div class="content">

        <header class="header-content flex justify-between items-center h-20 bg-white  px-4 drop-shadow-md">
            @yield('header')
        </header>

        @yield('content')
    </div>



</body>
<script src="{{ asset('lib/jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('js')

</html>
