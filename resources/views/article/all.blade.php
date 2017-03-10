@extends('main_layout')

@section('title')
    Все новости
    @stop

@section('headExtra')
    <link href="/css/article/common.css" rel="stylesheet">
    <link href="/css/article/all.css" rel="stylesheet">
    <link href="/css/article/preview.css" rel="stylesheet">
    @stop

@section('content')
    <div class="container common-article-container">
        <div class="row">
            <div class="col-xs-8 common-article-background">
                {{--Сделать отдельный шаблон для превью--}}
                @foreach ($articles as $article)
                    @include('article/preview')
                @endforeach

                {{--Навигация страничек        --}}
                {{--<div class="col-xs-1 c">&nbsp;</div>--}}
                <div class="col-xs-12">
                    <div class="wrapper all-wrapper">{{ $articles->render() }}</div>
                </div>
                {{--<div class="col-xs-1 c">&nbsp;</div>--}}
            </div>

            <div class="col-xs-4 common-category-container">

                <div class="wrapper"><h4 class="common-category-title">Категории</h4></div>

                <ul class="common-category-list">
                    <hr class="common-category-hr">
                    @foreach($categories as $category)
                        <li class="common-category-field">
                            <a href="">
                                <span class="pull-right common-category-font">{{$category->name}}</span>
                            </a>
                        </li>
                        <hr class="common-category-hr">
                    @endforeach
                </ul>
            </div>

        </div>
    </div>


    @stop