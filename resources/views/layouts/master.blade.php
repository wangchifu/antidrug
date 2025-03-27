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
    <meta http-equiv="Content-Security-Policy" content="default-src 'none';img-src 'self' data:;style-src 'self';script-src 'self' 'unsafe-inline';font-src 'self';">
    <title>{{ $setup->website_name }}</title>
    
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
    <link rel="stylesheet" href="{{ asset('venobox/venobox.min.css') }}" type="text/css" media="screen">
    <script src="{{ asset('venobox/venobox.min.js') }}"></script>
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            <?php
            $schools = config('antidrug.schools');
            ?>
            @if(auth()->check())
                <a href="{{ route('logout') }}" onclick="return confirm('確定登出？');">
                    @if(!empty(auth()->user()->school_code))
                        {{ $schools[auth()->user()->school_code] }}
                    @endif
                    {{ auth()->user()->name }} <i class="fas fa-sign-out-alt"></i>
                </a>
            @else
                <a href="{{ route('login') }}"><i class="fa fa-user"></i> 登入</a>
            @endif
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        @include('layouts/top_link')
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fas fa-at"></i> <a href="{{ env('APP_URL') }}" style="color:black;">{{ $setup->website_name }}</a></li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="header__top__left">
                        <ul>
                            <li><a href="{{ env('APP_URL') }}" style="color:black;"><i class="fas fa-at"></i> {{ $setup->website_name }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="https://drug.chshb.gov.tw/" target="_blank"><i class="fas fa-cloud"></i> 彰化縣政府毒品危害防制中心</a>
                            <a href="https://enc.moe.edu.tw/home" target="_blank"><i class="fas fa-kaaba"></i> 防制學生藥用濫用資源網</a>
                            <a href="https://antidrug.moj.gov.tw" target="_blank"><i class="fas fa-landmark"></i> 反毒大本營</a>
                        </div>
                        <div class="header__top__right__auth">
                            <?php
                            $schools = config('antidrug.schools');
                            ?>
                            @if(auth()->check())
                                <a href="{{ route('logout') }}" onclick="return confirm('確定登出？');">
                                    @if(!empty(auth()->user()->school_code))
                                        {{ $schools[auth()->user()->school_code] }}
                                    @endif
                                    {{ auth()->user()->name }} <i class="fas fa-sign-out-alt"></i>
                                </a>
                            @else
                                <a href="{{ route('login') }}"><i class="fa fa-user"></i> 登入</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('images/logo.svg') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-9">
                <nav class="header__menu">
                    @include('layouts/top_link')
                </nav>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('layouts/left_list')
                @yield('left_image')
            </div>
            <div class="col-lg-9">
                @yield('content')
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

@yield('section')

@include('layouts.footer')

<!-- Js Plugins -->
<script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('ogani/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ogani/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('ogani/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('ogani/js/mixitup.min.js') }}"></script>
<script src="{{ asset('ogani/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('ogani/js/main.js') }}"></script>
<script>
    var vb = new VenoBox({
        selector: '.venobox',
        numeration: true,
        infinigall: true,
        //share: ['facebook', 'twitter', 'linkedin', 'pinterest', 'download'],
        spinner: 'rotating-plane'
    });

    $(document).on('click', '.vbox-close', function() {
        vb.close();
    });

</script>
</body>

</html>
