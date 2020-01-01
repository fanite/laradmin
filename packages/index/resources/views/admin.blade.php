<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/vendor/backend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>😍 Loading...</title>
</head>

<body>
    <noscript>
        <strong>We're sorry but vue doesn't work properly without JavaScript enabled. Please enable it to
            continue.</strong>
    </noscript>
    <div id="app" v-cloak></div>
    <script>
        window.admin = @json($config)
    </script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
</body>

</html>
