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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
    class="font-sans antialiased relative bg-gray-800"
    x-data="{ showBalance: false, modalMain: false, modalDelete: false, modalCategories: false, modalCreateCategory: false, modalBanks: false, modalCreateBank: false }"
    x-effect="document.querySelector('html').classList.toggle('overflow-y-hidden', modalCategories)">
        <div class="min-h-screen">
            <livewire:layout.navigation />

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <x-layouts.footer />
    </body>
</html>
