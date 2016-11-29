<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>@yield('title') - MyBlog</title>
    <meta name="keywords" content="Блог, новости, IT, гаджеты, PHP, програмирование">
    <meta name="description" content="Актуальные новости из мира програмирования и гаджетов">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery & jQuery UI -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- Bootstrap -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link href="/bootstrap/css/custom-template.css" rel="stylesheet">
    <link href="/bootstrap/css/custom-news.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('headExtra')
</head>
<body>
<div class="navbar navbar-inverse navbar-custom" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header col-sm-6 col-xs-12 navbar-brand-custom">
                <a class="navbar-brand" href="/">
                    <strong>MyBlog</strong>
                </a>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="col-md-2 col-sm-1">&nbsp;</div>
            <div class="navbar-default col-sm-5 col-md-4 hidden-xs ">
                <ul class="nav navmenu-nav navmenu-custom">
                    <li><a href="">Главная    </a></li>
                    <li><a href="">Обо мне    </a></li>
                    <li><a href="">Контакты   </a></li>
                </ul>
            </div>

        </div><!--/.navbar-collapse -->
    </div>
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