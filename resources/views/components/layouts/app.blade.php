<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'RoyaltyRewards') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">

<div class="min-h-screen flex" x-data="{ sidebarOpen: false }">

    {{-- Mobile overlay --}}
    <div
        class="fixed inset-0 z-20 bg-black/50 lg:hidden"
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
    ></div>

    {{-- Sidebar --}}
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white flex flex-col transform transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:z-auto"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-700">
            <div class="flex items-center justify-center w-8 h-8 bg-indigo-500 rounded-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="font-bold text-lg tracking-tight">RoyaltyRewards</span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                <x-slot name="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </x-slot>
                Dashboard
            </x-sidebar-link>

            <x-sidebar-link :href="route('customers.index')" :active="request()->routeIs('customers.*')" wire:navigate>
                <x-slot name="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </x-slot>
                Customers
            </x-sidebar-link>

            <x-sidebar-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')" wire:navigate>
                <x-slot name="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </x-slot>
                Transactions
            </x-sidebar-link>

            <x-sidebar-link :href="route('rewards.index')" :active="request()->routeIs('rewards.*')" wire:navigate>
                <x-slot name="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                </x-slot>
                Rewards
            </x-sidebar-link>

            <x-sidebar-link :href="route('redemptions.index')" :active="request()->routeIs('redemptions.*')" wire:navigate>
                <x-slot name="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </x-slot>
                Redemptions
            </x-sidebar-link>

            <div class="pt-4 mt-4 border-t border-gray-700">
                <x-sidebar-link :href="route('settings.index')" :active="request()->routeIs('settings.*')" wire:navigate>
                    <x-slot name="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </x-slot>
                    Settings
                </x-sidebar-link>
            </div>
        </nav>

        {{-- User area --}}
        <div class="px-4 py-4 border-t border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-sm font-semibold flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? '' }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Sign out" class="text-gray-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="flex-1 flex flex-col min-w-0">
        {{-- Top bar (mobile hamburger + page title) --}}
        <header class="bg-white border-b border-gray-200 px-4 sm:px-6 py-4 flex items-center gap-4">
            <button
                class="lg:hidden text-gray-500 hover:text-gray-700"
                @click="sidebarOpen = true"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="flex-1">
                {{ $header ?? '' }}
            </div>
        </header>

        {{-- Global loading bar --}}
        <div wire:loading.delay wire:loading.class.remove="hidden"
             class="hidden fixed top-0 left-0 right-0 z-50 h-0.5 bg-indigo-200">
            <div class="h-full bg-indigo-600 animate-pulse w-full"></div>
        </div>

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
</div>

</body>
</html>
