<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Tracker</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-200">
    <nav class="p-2 bg-white flex justify-between font-semibold text-green-950 ">
        <ul class="flex item-center">
            <li class="p-6"><a href="{{ route('home') }}">
                    Home</a></li>
            @auth
                @if (\Auth::user()->type != 'admin')
                    <li class="p-6"><a href="{{ route('apply-leave') }}">Apply Leave</a></li>
                @endif
            @endauth

            <li class="p-6"><a href="{{ route('leave') }}">
                    Leave History</a></li>

            <li class="p-6">#</li>
            <li class="p-6">#</li>
            <li class="p-6">#</li>
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
