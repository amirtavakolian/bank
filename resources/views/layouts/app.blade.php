<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/img/icon.gif" type="image/gif">
    <title dir="rtl">{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <style type="text/css">
        @font-face {
            font-family:'Font';
            src: url( {{asset('fonts/'.config('app.font'))}} );
        }
        body, html {
            height: 100%;
            margin: 0;
        }

        .bg {
            background-image: url("/img/bg.png");
            height: 100%;
            background-position: center;
            background-repeat: repeat-y;
            background-size: cover;
        }
    </style>

    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('js/autoNumeric-1.9.18.js') }}"></script>
    <script type='text/javascript'>
        $(function($) {
            $('#payment').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
        });
        $(function($) {
            $('#loan_payment').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
        });
        $(function($) {
            $('#loan_payment_force').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
        });
        $(function($) {
            $('#payment_cost').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
        });
        $(function($) {
            $('#loan').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
        });
        $(function($) {
            $('#expense').autoNumeric('init', {  lZero: 'deny', aSep: ',', mDec: 0 });
        });
    </script>

</head>
<body style="font-family:'Font'" class="bg">
    <nav class="navbar navbar-default"></nav>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a dir="rtl" class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="{{ route('login') }}">ورود</a></li>
                    @else
                        @if (Auth::user()->is_admin==1)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    ابزارها <span class="caret"></span>
                                </a>
                            <ul class="dropdown-menu">

                                <li class="text-center">

                                    <a href="{{ route('notification') }}">اعلان ها</a>

                                    <a href="{{ route('slider') }}">اسلایدر</a>

                                    <a href="{{ route('expense') }}">هزینه های صندوق</a>

                                    <a href="{{ route('register') }}">ثبت اطلاعات عضو</a>

                                    <a href="{{ Storage::url('public/Mysql_Backup_Ghaem.sql') }}" onclick="return confirm('آیا از دانلود دیتابیس اطمینان دارید؟')" >
                                        <span class="glyphicon glyphicon-download-alt"></span>
                                        دانلود دیتابیس
                                    </a>

                                </li>
                            </ul>

                            <li>
                                <a href="{{ route('notes') }}">
                                    <div class="badge">
                                        {{App\User::where('note','!=',null)->count()+App\User::where('user_note','!=',null)->count()}}
                                    </div>
                                    پیام ها
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('instalment') }}">
                                    <div class="badge">
                                        {{App\User::where('instalment','!=',null)->count()+App\User::where('instalment_force','!=',null)->count()}}
                                    </div>
                                    اقساط فعال
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('unproved') }}">
                                    <div class="badge">
                                        {{App\Payment::where('is_proved','=','0')->count()+App\Loan::where('is_proved','=','0')->count()}}
                                    </div>
                                    تایید تراکنش
                                </a>
                            </li>

                            <li><a href="{{ route('admin') }}">صفحه مدیریت</a></li>
                        @endif


                        <li> <a href="{{ route('home') }}">تراکنش ها</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="text-center">

                                    <a href="#"><span class="glyphicon glyphicon-time"></span>{{str_before(\Hekmatinasser\Verta\Verta::now(),' ')}}:امروز</a>

                                    <a href="#"><span class="glyphicon glyphicon-map-marker"></span>{{Request::getClientIp()}}:IP</a>

                                    <a style="color: red" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                        <span class="glyphicon glyphicon-log-out"></span>
                                        خروج
                                            </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    </form>

                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    
        @yield('content')
    <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
