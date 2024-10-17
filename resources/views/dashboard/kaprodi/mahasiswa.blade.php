@extends('dashboard.KaprodiLayout')

@section('header')

<p class="text-2xl bold">Hallo {{ Auth::user()->name }} , Anda adalah {{ Auth::user()->role }}</p>

@endsection


@section('content')

<p>ini mahasiswa</p>

@endsection
