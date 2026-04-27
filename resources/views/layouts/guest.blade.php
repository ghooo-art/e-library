<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ghooo Library') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased relative min-h-screen">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/library-bg.png') }}" alt="Library Background" class="w-full h-full object-cover">
            <!-- Overlay to ensure text readability -->
            <div class="absolute inset-0 bg-slate-900/60 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-ghooo-900/40"></div>
        </div>

        <div class="relative z-10 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-4">
            <div class="mb-8 animate-fade-in-up hover:scale-105 transition-transform duration-300">
                <a href="/" class="text-4xl font-black font-outfit tracking-tighter text-white drop-shadow-lg flex flex-col items-center group">
                    <span class="w-16 h-16 rounded-2xl bg-gradient-to-br from-ghooo-500 to-accent flex items-center justify-center text-white shadow-xl mb-4 border border-white/20">
                        <span class="material-symbols-outlined text-4xl">auto_stories</span>
                    </span>
                    Ghooo Library
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 glass-dark bg-slate-900/70 shadow-2xl overflow-hidden sm:rounded-3xl border border-white/10 animate-fade-in-up animation-delay-200">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
