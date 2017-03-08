@extends('layout')

@section('title')
    Все новости
    @stop

@section('headExtra')
    <link href="/bootstrap/css/custom-news-add.css" rel="stylesheet">
    <link href="/bootstrap/css/custom-news-preview.css" rel="stylesheet">
    @stop

@section('content')
    <div class="container padding-container">
        <div class="row">
            <div class="col-xs-8 background-news">
                {{--Сделать отдельный шаблон для превью--}}
                @foreach ($articles as $article)
                    @include('article/preview')
                @endforeach

                {{--Навигация страничек        --}}
                {{--<div class="col-xs-1 c">&nbsp;</div>--}}
                <div class="col-xs-12">
                    <div class="wrapper-pag">{{ $articles->render() }}</div>
                </div>
                {{--<div class="col-xs-1 c">&nbsp;</div>--}}
            </div>

            <div class="col-xs-4 news-container-categories-padding">

                <div class="wrapper"><h4 class="news-categories-title">Категории</h4></div>

                <ul class="news-categories-list">
                    <hr class="hr-custom">
                    @foreach($categories as $category)
                        <li class="news-category-field">
                            <a href="">
                                {{--@if (isset($counters[$key]))--}}
                                    {{--<span class="pull-left">{{}}</span>--}}
                                {{--@endif--}}
                                <span class="pull-right news-category-font">{{$category->name}}</span>
                            </a>
                        </li>
                        <hr class="hr-custom">
                    @endforeach
                </ul>
            </div>

        </div>
    </div>


    @stop