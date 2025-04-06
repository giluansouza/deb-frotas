<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <x-header />
        <main class="flex-grow">
            <x-hero />
            <x-feature-grid />
        </main>
        <x-footer />
    </body>
</html>
