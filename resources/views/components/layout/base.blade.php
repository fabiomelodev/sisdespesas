<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Despesas</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?ver=1.1">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?ver=1.1">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?ver=1.1">
        <link rel="manifest" href="/site.webmanifest?ver=1.1">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <link rel="canonical" href="{{  url()->current() }}" />
        @vite('resources/js/app.js')
    </head>
    <body class="bg-gray-800">
        <style>
            [x-cloak] {
                display: none;
            }
        </style>

        <x-layout.header />
            <main>
                {{ $slot }}
            </main>
        <x-layout.footer />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    </body>
</html>
