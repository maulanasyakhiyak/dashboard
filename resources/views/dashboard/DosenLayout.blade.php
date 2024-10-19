<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'public/css/dosen.css'])
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/solid.css') }}">
    @yield('css')
    <title>Dashboard</title>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h2>DASHBOARD ADMIN</h2>
        </div>
        
        <ul class="sidebar-warp my-4">
            <li class="sidebar-item {{ request()->routeIs('Dashboardkaprodi') ? 'active' : '' }}">
                <a href="{{ route('Dashboardkaprodi') }}"><i class="fa-solid fa-gauge pe-4"></i>Dashboard</a>
            </li>
        </ul>

        <form action="{{ route('logout') }}" method="post" class="absolute bottom-10">
            @csrf
            <button type="submit" class="sidebar-item text-white"><i class="fa-solid fa-arrow-right-from-bracket pe-4"></i>Logout</button>
        </form>
    </div>

    <div class="content">

        <header class="header-content flex justify-between items-center h-16 bg-white  px-6 drop-shadow-md">
@yield('header')
        </header>

        <div class="content-sec">
            @yield('content')
        </div>
    </div>



</body>
<script src="{{ asset('lib/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

@yield('js')

</html>
