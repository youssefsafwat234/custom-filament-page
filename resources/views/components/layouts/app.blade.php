<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- If using Vite -->
    @livewireStyles
</head>
<body>
{{ $slot }} <!-- This renders the content inside the layout -->
@livewireScripts
</body>
</html>
