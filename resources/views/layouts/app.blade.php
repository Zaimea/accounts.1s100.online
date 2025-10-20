<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

     {{-- Primary Meta Tags --}}
    <title>{{ isset($title) ? $title . ' - ' : null }}{{ config('app.name', 'Zaimea.com') }} - Calendar Schedule for your working time</title>
    <meta name="description" content="Zaimea is the basis for Zaimea.com, which is developed for companies that want to ease their work in keeping track of employees' working hours.">

     {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#ff2d20">
    <link rel="shortcut icon" href="/img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ff2d20">
    <meta name="msapplication-config" content="/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="color-scheme" content="light">

     {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

     {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <x-banner />
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')
         {{-- Page Heading --}}
        @if (isset($header))
            <header>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
         {{-- Page Content --}}
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('modals')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        var notyf = new Notyf();
        Livewire.on('successAlert', alertMessage => {
            notyf.success(alertMessage);
        });
        Livewire.on('errorAlert', alertMessage => {
            notyf.error(alertMessage);
        });
    </script>
</body>
</html>
