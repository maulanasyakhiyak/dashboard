<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'public/css/layout.css'])
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
            <li class="sidebar-item {{ request()->routeIs('DashboardDosen') ? 'active' : '' }}">
                <a href="{{ route('DashboardDosen') }}"><i class="fa-solid fa-gauge pe-4"></i>Dashboard</a>
            </li>
        </ul>
    </div>

    <div class="content">

        <header class="header-content flex justify-between items-center h-20 bg-white  px-4 drop-shadow-md">
            <p class="text-2xl bold">Hallo {{ Auth::user()->name }} , Anda adalah {{ Auth::user()->role }}</p>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="button">Logout</button>
            </form>
        </header>

        @yield('content')
    </div>



</body>
<script src="{{ asset('lib/jquery.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('js')

</html>
