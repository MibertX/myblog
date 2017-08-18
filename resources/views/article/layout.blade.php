@extends('main_layout')

@section('headExtra')
    <link href="/css/article/common.css" rel="stylesheet">
    <link href="/css/article/preview.css" rel="stylesheet">
    <link href="/css/comment.css" rel="stylesheet">
    <script src="/js/blog.js"></script>
@stop

@section('content')
    <div class="container common-article-container">
        <div class="row">
            <div class="col-xs-9 common-article-background">
                @yield('post')
                @yield('posts')
            </div>

            <div class="col-xs-3 common-category-container">
                <div class="wrapper"><h4 class="common-category-title">{{trans('posts.category_title')}}</h4></div>

                <ul class="common-category-list">
                    @foreach($categories as $category)
                        <li class="common-category-field{{session('category') == $category->name ? ' common-category-active':'' }}">
                            <a href="{{route('getByCategories', ['category' => $category->name])}}">
                                <span class="pull-left common-category-font">{{$category->posts}}</span>
                                <span class="pull-right common-category-font">{{strtr($category->name, trans('posts.categories'))}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop