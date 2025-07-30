{{-- resources/views/admin/auth/confirmation.blade.php --}}

<x-layouts.guest-layout>

    <div class="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
        <div class="relative flex flex-col justify-center w-full h-screen dark:bg-gray-900 lg:flex-row">
            
            
            @include('components.admin.confirmation-message', ['username' => $username])
            @include('components.admin.auth.common-grid')

        </div>
    </div>


</x-layouts.guest-layout>
