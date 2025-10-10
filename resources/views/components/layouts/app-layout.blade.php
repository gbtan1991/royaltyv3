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
    <script src="https://kit.fontawesome.com/266a593bd6.js" crossorigin="anonymous"></script>


    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body 
    x-data="{ sidebarToggle: true }"

>
    
    <div class="flex h-screen overflow-hidden">
        <x-partials.sidebar /> 

        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <x-partials.header.header />

            
        <div class=" min-h-screen">
        {{ $slot }}
        </div>

        </div>
        


    </div>


    
    
</body>
</html>