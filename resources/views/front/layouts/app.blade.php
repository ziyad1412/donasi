<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    @stack('before-style')
    <link href=" {{ asset('css/output.css') }}  " rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/flickity.min.css') }}" media="screen">
    @stack('after-style')

    <title>@yield('title')</title>
</head>

<body class="font-poppins text-[#292E4B] bg-[#F6F9FC]">

    {{-- section yield content --}}
    @yield('content')


    @stack('before-script')
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/js/flickity.pkgd.min.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    @stack('after-script')
</body>

</html>
