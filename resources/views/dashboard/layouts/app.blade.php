<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnterpreneurHub</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('extra-css')
</head>
<body>
    <nav class="px-6 py-4 fixed top-0 h-20 bg-white w-full z-10">
        @include('dashboard.layouts.navbar')
    </nav>
    <hr /> 

    <div class="flex">
        <aside class="border-r-[1px] w-1/5 h-screen fixed top-0 bg-white overflow-y-auto">
            @include('dashboard.layouts.sidebar')
        </aside>

        <main class="bg-[#f8fafc] w-4/5 ml-auto px-7 py-8 mt-16">
            <header>
                @include('dashboard.layouts.header')
            </header>

            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    @yield('modal')
    
    @yield('extra-js')
</body>
</html>