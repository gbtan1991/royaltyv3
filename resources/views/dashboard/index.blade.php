<x-layouts.app-layout>

    <!-- Page Wrapper -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        @include('components.dashboard.sidebar')

        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
        <!-- Mobile Device Overlay -->
        @include('components.dashboard.overlay')


        <!-- Header -->
        @include('components.dashboard.header')

      

        <!-- Main Content -->
        <main>

       
        </div>

    </div>

</x-layouts.app-layout>
