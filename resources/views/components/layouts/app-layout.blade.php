<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>{{ config('app.name', 'Laravel App')}}</title>

     <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body 

    x-data="{ page: 'royalty', 'loaded', darkMode: 'false'}">
    <x-partials.header />
    <div class="dark:bg-gray-900 dark:text-gray-100 min-h-screen">
    {{ $slot }}
    </div>
    
</body>
</html>