<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @vite('resources/css/app.css')

</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            <form action="{{ route('loginProses') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="label-form">Email</label>
                    <input type="email" id="email" name="email" class="input-form" value="{{ old('email') }}">
                    @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="label-form">Password</label>
                    <input type="password" id="password" name="password" class="input-form">
                    @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="button-full">Login</button>
            </form>
        </div>
    </div>

</body>
</html>
