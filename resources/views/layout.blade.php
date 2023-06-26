<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('page-title')
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
</head>
<body class="bg-theme-dark-blue text-white h-screen">
    @yield('content')
    <div class="notification-container">

    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/ee897ad789.js"></script>
    <script src="{{ url('assets/js/jQuery-plugin-progressbar.js') }}"></script>
    <script src="{{ url('assets/js/components.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>
    <script src="{{ url('assets/js/script.js') }}"></script>
    @yield('script')
</body>
</html>