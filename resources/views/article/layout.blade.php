@extends('main_layout')

@section('headExtra')
    <link href="/css/article/common.css" rel="stylesheet">
    <link href="/css/article/preview.css" rel="stylesheet">
    <link href="/css/comment.css" rel="stylesheet">
    <script src="/js/blog.js"></script>
@stop

@section('content')
    <div class="container-fluid common-article-container">
        <div class="row">
            <div class="col-xs-9 col-lg-10">
                <div class="common-article-background">
                    @yield('post')
                    @yield('posts')
                </div>
            </div>

            <div class="col-xs-3 col-lg-2 common-category-container">
                <div class="wrapper">
                    <h4 class="common-category-title">{{trans('posts.category_title')}}</h4>
                </div>

                <ul class="common-category-list">
                    <li {{session('category') == 'all' ? 'id=common-category-current' : ''}}>
                        <a href="{{route('allArticles')}}">
                            <span>{{trans('categories.all_categories')}}</span>
                        </a>
                    </li>

                    @foreach($categories as $category)
                        <li {{session('category') == $category->name ? 'id=common-category-current' : ''}}>
                            <a href="{{route('getByCategories', ['category' => $category->name])}}">
                                <span class="pull-left">{{$category->posts}}</span>
                                <span class="pull-right">{{strtr($category->name, trans('posts.categories'))}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop