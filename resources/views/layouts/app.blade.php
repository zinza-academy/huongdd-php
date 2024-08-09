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

        {{-- datepicker --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        {{-- select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />

        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/43.0.0/ckeditor.min.js"></script>
        <script src="{{asset('js/jscolor.js')}}"></script>
        <script src="{{asset('js/functions.js')}}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
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
                <div class="mx-auto">
                    @if (Session::has('error'))
                        <x-session type="error">{{ Session::get('error', 'Action failed') }}</x-session>
                    @endif
                    @if (Session::has('success'))
                        <x-session type="success">{{ Session::get('success', 'Action performed successfully') }}</x-session>
                    @endif
                </div>
                {{ $slot }}
            </main>
        </div>
    </body>

    <script>
        ClassicEditor.create(document.querySelector( '#editor' ) , {
            ckfinder: {
                uploadUrl: "{{route('img.upload', ['_token' => csrf_token()])}}",
            }
        });
    </script>
</html>


