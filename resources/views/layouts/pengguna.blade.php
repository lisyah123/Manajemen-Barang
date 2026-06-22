<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Staff')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-800">
    <div class="flex h-screen overflow-hidden">
        
        @include('layouts.pengguna.sidebar')

        <div class="flex-1 flex flex-col relative overflow-hidden">
            
            @include('layouts.pengguna.navbar')
            
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
            
        </div>
    </div>
</body>
</html>