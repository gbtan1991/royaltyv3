<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Royalty Rewards App')}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700" rel="stylesheet" />

    

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/266a593bd6.js" crossorigin="anonymous"></script>
    
</head>
<body 
    x-data="{ darkMode: false }" 
    :class="{'dark bg-gray-900': darkMode === true}"
     class="bg-gray-100 text-gray-900 font-[outfit] h-screen"
>

    <div class="">
    {{ $slot }}    
    </div>

    
</body>
</html>