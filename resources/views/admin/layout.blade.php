@extends("main_layout")
@section('headExtra')
    <link href="/css/admin/layout.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin/table.css">
    <script src="/js/adminzone.js"></script>
    @yield('section_head_extra')
@stop

@section('content')
    <div class="container-fluid admin-main-container">
        <nav class="navmenu navmenu-default admin-main-menu" role="navigation">
            <div class="navbar" id="admin-nav">
                <ul class="nav navmenu-nav">
                    <li id="{{session('adminActive') == 'dashboard' ? 'dashboard-active' : 'dashboard-menu-item'}}">
                        <a href="{{route('dashboard')}}">
                            <span class="admin-menu-icon"><i class="fa fa-dashboard fa"></i></span>
                            <span class="item-name">
                                {{trans('admin.menu.dashboard')}}
                            </span>
                        </a>
                    </li>
                    <li id="{{session('adminActive') == 'users' ? 'users-active' : 'users-menu-item'}}" >
                        <a href="javascript://" data-toggle="collapse" data-target="#users_sub_menu">
                            <span class="admin-menu-icon">
                                <i class="fa fa-user"></i>
                            </span>
                            <span class="item-name">
                                {{trans('admin.menu.users')}}
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="collapse admin-sub-menu" role="menu" id="users_sub_menu">
                            <li>
                                <a href="{{route('allUsers')}}">
                                    {{trans('admin.submenu.all')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('createUserView')}}">
                                    {{trans('admin.submenu.create')}}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="{{session('adminActive') == 'posts' ? 'posts-active' : 'posts-menu-item'}}">
                        <a href="javascript://" data-toggle="collapse" data-target="#posts_sub_menu">
                            <span class="admin-menu-icon">
                                <i class="fa fa-file-text-o"></i>
                            </span>
                            <span class="item-name">
                                {{trans('admin.menu.posts')}}
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="collapse admin-sub-menu" role="menu" id="posts_sub_menu">
                            <li>
                                <a href="{{route('adminPostsView')}}">
                                    {{trans('admin.submenu.all')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('createPostView')}}">
                                    {{trans('admin.submenu.create')}}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="{{session('adminActive') == 'categories' ? 'categories-active' : 'categories-menu-item'}}">
                        <a href="javascript://" data-toggle="collapse" data-target="#categories_sub_menu">
                            <span class="admin-menu-icon">
                                <i class="fa fa-tags"></i>
                            </span>
                            <span class="item-name">
                                {{trans('admin.menu.categories')}}
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="collapse admin-sub-menu" role="menu" id="categories_sub_menu">
                            <li>
                                <a href="{{route('adminCategories')}}">
                                    {{trans('admin.submenu.all')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('categoryCreateView')}}">
                                    {{trans('admin.submenu.create')}}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="{{session('adminActive') == 'comments' ? 'comments-active' : 'comments-menu-item'}}">
                        <a  href="{{route('adminComments')}}">
                            <span class="admin-menu-icon">
                                <i class="fa fa-comments"></i>
                            </span>
                            <span class="item-name">
                                {{trans('admin.menu.comments')}}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('unisharp.lfm.show')}}" target="_blank">
                            <span class="admin-menu-icon">
                                <i class="fa fa-archive"></i>
                            </span>
                            <span class="item-name">
                                {{trans('admin.menu.files')}}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript://" id="button-menu">
                            <span class="admin-menu-icon">
                                <i class="fa fa-arrow-circle-o-right"></i>
                            </span>
                            <span class="item-name">
                                {{trans('admin.menu.close')}}
                            </span>
                        </a>
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
