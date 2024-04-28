<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Leave Tracker</title>
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> --}}
    <script src="https://kit.fontawesome.com/97a1f18299.js" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-200 font-mono">
    <nav class="p-2 bg-white flex justify-between font-semibold text-green-950 ">
        <ul class="flex item-center">
            <li class="p-6"><a href="{{ route('home') }}">
                    Dashboard</a></li>
            @auth
                @if (\Auth::user()->type != 'admin')
                    <li class="p-6"><a href="{{ route('apply-leave') }}">Apply Leave</a></li>
                @else
                    <li class="p-6"><a href="{{ route('user') }}">Manage Users</a></li>
                @endif
            @endauth

            <li class="p-6"><a href="{{ route('leave') }}">
                    Leave History</a></li>

        </ul>
        <ul class="flex item-center">
            @auth
                <li class="p-6">{{ auth()->user()->name }}</li>
                <form action="{{ route('logout') }}" method="POST" class="p-6">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endauth
            @guest
                <li class="p-6"><a href="{{ route('login') }}">
                        Login</a></li>
                <li class="p-6"><a href="{{ route('register') }}">
                        Register</a></li>
            @endguest
        </ul>
    </nav>
    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
</body>

</html>
