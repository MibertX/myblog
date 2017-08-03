@extends("main_layout")
@section('headExtra')
    <link href="/css/admin/layout.css" rel="stylesheet">
    @endsection

@section('content')
    <div class="container-fluid admin-main-container">
        <nav class="navmenu navmenu-default admin-main-menu" role="navigation">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#admin-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse" id="admin-nav">
                <ul class="nav navmenu-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Users&nbsp;<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu navmenu-nav admin-sub-menu" role="menu">
                            <li>
                                <a href="{{route('allUsers')}}">All</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{trans('admin.posts.link')}}&nbsp;<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu navmenu-nav admin-sub-menu" role="menu">
                            <li><a href="{{route('adminPostsView')}}">{{trans('admin.posts.all')}}</a></li>
                            <li><a href="{{route('createPostView')}}">{{trans('admin.posts.create_btn')}}</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{trans('admin.categories')}}&nbsp;<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu navmenu-nav admin-sub-menu" role="menu">
                            <li><a href="{{route('adminCategories')}}">{{trans('admin.all')}}</a></li>
                            <li><a href="{{route('categoryCreateView')}}">{{trans('admin.add_category')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="content-wrapper">
            <div class="container-fluid admin-content-container">
                @yield('admin-section')
            </div>
        </div>
    </div>
@stop
