<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIAKAD') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-900">
        <div class="flex min-h-screen">
            
            @include('layouts.navigation')

            <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
                
                <header class="bg-white border-b border-slate-100 h-16 flex items-center justify-between px-8 shrink-0">
                    <div class="font-semibold text-slate-800 text-lg">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2 bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-100">
                            <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Sistem Aktif</span>
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto p-8 bg-slate-50/50">
                    {{ $slot }}
                </main>
                
            </div>
        </div>
    </body>
</html>