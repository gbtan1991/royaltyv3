<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Royalty Rewards App') }}</title>

    <!--- Fonts --->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!--- Style Scrips --->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- favicon --->
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}" />

</head>

<body 
    x-data="{ sidebarToggle: false, darkMode: true }"
    :class="{ 'dark': darkMode === true }"
    class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white transition-colors duration-300"
>
    
    

    <div class="flex h-screen overflow-hidden dark:bg-black">
        @include('components.partials.sidebar')

        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            @include('components.partials.overlay')
            @include('components.partials.header')

            {{ $slot }}
        </div>

    </div>



</body>

</html>
