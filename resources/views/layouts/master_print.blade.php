<?php
$setup = \App\Models\Setup::first();
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="default-src 'none'; img-src 'self' data:;">
    <title>彰化縣政府毒品危害防制中心預防宣導組</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('ogani/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ogani/css/style.css') }}" type="text/css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.10.2-web/css/all.css')}}">
</head>

<body onload="window.print()">
<style>
    .table td{
        border: black solid 1px !important;
    }
    .table th{
        border: black solid 1px !important;
    }
</style>
@yield('content')

<!-- Js Plugins -->
<script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('ogani/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ogani/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('ogani/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('ogani/js/mixitup.min.js') }}"></script>
<script src="{{ asset('ogani/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('ogani/js/main.js') }}"></script>

</body>

</html>
