<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


        {{-- Toast --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="mx-auto py-3 pl-7 bg-gray-100 pl-2">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>

    @if (\Session::has('message'))
        const type = "{{\Session::get('type', 'info')}}";
        const timeOut = 5000;
        switch (type) {
            case 'info':
                toastr.options.timeOut = timeOut;
                toastr.info("{{\Session::get('message')}}");
                break;
            case 'warning':
                toastr.options.timeOut = timeOut;
                toastr.warning("{{\Session::get('message')}}");
                break;
            case 'success':
                toastr.options.timeOut = timeOut;
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.options.timeOut = timeOut;
                toastr.error("{{\Session::get('message')}}");
                break;
        }
    @endif
</script>
