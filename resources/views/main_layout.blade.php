<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>@yield('title') - MyBlog </title>
    <meta name="keywords" content="Блог, новости, IT, гаджеты, PHP, програмирование">
    <meta name="description" content="Актуальные новости из мира програмирования и гаджетов">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery & jQuery UI -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Jasny bootsrap -->
    <script src="/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <link rel="stylesheet" href="/jasny-bootstrap/css/jasny-bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.css">

    <!-- Summernote -->
    <script src="/summernote/summernote.js"></script>
    <link href="/summernote/summernote.css" rel="stylesheet">

    <!-- Custom stylesheets -->
    <link href="/css/main_layout.css" rel="stylesheet">
    <script src="/js/popup-msg.js"></script>
    @yield('headExtra')
</head>

<body>
@section('auth')
    @include('partials.auth_buttons')
@stop

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/">
                MyBlog
            </a>

            <div class="dropdown dropdown-lang">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="/css/elements/flags/{{session('locale')}}.png" class="img-flag">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-lang-menu">
                    @foreach(config('app.languages') as $lang)
                        @if (session('locale') !== $lang)
                            <li>
                                <a href="{{route('locale', ['lang' => $lang])}}">
                                    <img src="/css/elements/flags/{{$lang}}.png">
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="nav nav-auth pull-right hidden-sm visible-xs ">
                @yield('auth')
            </div>
        </div>

        <div class="collapse navbar-collapse navbar-left" id="main-nav">
            <ul class="nav navbar-nav">
                {{--<li class="dropdown dropdown-lang">--}}
                    {{--<a class="dropdown-toggle" data-toggle="dropdown">--}}
                        {{--<img src="./css/elements/flags/{{session('locale')}}.png">--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--@foreach(config('app.languages') as $lang)--}}
                            {{--@if (app()->getLocale() !== $lang)--}}
                                {{--<li><a href="{{route('locale', ['lang' => $lang])}}">{{$lang}}</a></li>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li class="main-nav-item" id="{{session('active') == 'main' ? 'current' : ''}}">
                    <a href="{{route('home')}}">{{trans('nav.main')}}</a>
                </li>
                <li class="main-nav-item" id="">
                    <a href="">{{trans('nav.about')}}</a>
                </li>
                <li class="main-nav-item" id="">
                    <a href="">{{trans('nav.contact')}}</a>
                </li>
                <li class="main-nav-item" id="">
                    <a href="">Testing</a>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->

        <div class="nav navbar-right nav-auth hidden-xs visible-sm visible-lg visible-md">
            @yield('auth')
        </div>
    </div><!-- /.container-fluid -->
</nav>

<div id="notification">
    @if(session('ok'))
        @include('partials.message_partial', ['type' => 'ok', 'message' => session('ok')])
        {{session()->forget('ok')}}
    @endif

    @if(session('info'))
        @include('partials.message_partial', ['type' => 'info', 'message' => session('info')])
        {{session()->forget('info')}}
    @endif

    @if(session('error'))
        @include('partials.message_partial', ['type' => 'error', 'message' => session('error')])
        {{session()->forget('error')}}
    @endif
</div>

@yield('content')

<div id="footer">
    <div class="container">
        <div class="col-xs-12">
            MyBlog &copy; 2016 - All rights reserved
        </div>
    </div>
</div>
</body>
</html>















{{--<nav class="navbar navbar-fixed-top main-navbar" role="navigation">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
        {{--<div class="navbar-header main-brand">--}}
            {{--<button type="button" class="navbar-toogle collapsed" data-toggle="collapse"--}}
                    {{--data-target="#bs-example-navbar-collapse-1">--}}
                {{--<span class="sr-only">Toggle navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}
            {{--<a class="" href="/">--}}
                {{--<strong>MyBlog</strong>--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">--}}
            {{--<ul class="nav nav-pills">--}}
                {{--<li class="a nav-item"><a href="">Главная    </a></li>--}}
                {{--<li class="nav-item"><a href="">Обо мне    </a></li>--}}
                {{--<li class="nav-item"><a href="">Контакты   </a></li>--}}
                {{--<li class="nav-item"><a href="">Testing</a></li>--}}
                {{--<li class="a nav-item"><a href="">Testing</a></li>--}}
            {{--</ul>--}}
        {{--</div><!-- /.navbar-collapse -->--}}


        {{--<div class="nav navbar-right">--}}
        {{--@if(Auth::check())--}}

        {{--@else--}}
        {{--<button class="btn btn-success">--}}
        {{--<a href="">Login</a>--}}
        {{--</button>--}}
        {{--<button class="btn btn-info">--}}
        {{--<a href="">Register</a>--}}
        {{--</button>--}}
        {{--@endif--}}
        {{--</div>--}}





        {{--</div>--}}
    {{--</div>--}}
{{--</nav>--}}