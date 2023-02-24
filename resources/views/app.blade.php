<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Primary Meta Tags -->
        <title>Storm Sacco - Sacco Management System</title>
        <meta name="title" content="Storm Sacco - Sacco Management System">
        <meta name="description" content="A great tool to help manage and streamline the operations of any microfinance Sacco.">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://sacco.infinitylabs.africa/">
        <meta property="og:title" content="Storm Sacco - Sacco Management System">
        <meta property="og:description" content="A great tool to help manage and streamline the operations of any microfinance Sacco.">
        <meta property="og:image" content="https://sacco.infinitylabs.africa/img/logoAsset2@4x.png">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://sacco.infinitylabs.africa/">
        <meta property="twitter:title" content="Storm Sacco - Sacco Management System">
        <meta property="twitter:description" content="A great tool to help manage and streamline the operations of any microfinance Sacco.">
        <meta property="twitter:image" content="https://sacco.infinitylabs.africa/img/logoAsset2@4x.png">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-gray-100">
        @inertia
    </body>
</html>
