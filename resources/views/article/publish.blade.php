@extends('main_layout')
@include('error_sections')


@section('title')
    Добавить новость
    @stop

@section('headExtra')
    <link href="/css/article/common.css" rel="stylesheet">
    <link href="/css/article/publish.css" rel="stylesheet">
    @stop

@section('content')

<div class="container common-article-container">
    <form method="post" action="{{route('publish')}}" accept-charset="utf-8"
          enctype="multipart/form-data" role="form">
        {{csrf_field()}}
    <div class="row">
        {{--Left side of the form - input fields--}}
        <div class="col-xs-8 common-article-background">
            <div class="publish-input-background">
                <label for="title" class="control-label publish-label col-xs-12">Название статьи</label>
                <input type="text" name="title" id="title" class="form-control publish-input">
                @yield('title_error')
            </div>

            <div class="publish-input-background">
                <label for="text" class="control-label publish-label col-xs-12">Текст статьи</label><br>
                <textarea class="form-control publish-input" rows="18" name="text" id="text"></textarea>
                @yield('text_error')
            </div>

            <div class="col-xs-12">
                <div class="wrapper">
                    <button type="submit" class="btn btn-primary submit-button">Добавить</button>
                </div>
            </div>
        </div>

        {{--Right side of the form - checkboxes for selecting categories--}}
        <div class="col-xs-4 common-category-container">
            <div class="wrapper">
                <h4 class="common-category-title">Категории</h4>
            </div>

            <ul class="common-category-list">
                <hr class="common-category-hr">
                @foreach($categories as $key=>$value)
                    <li>
                        <label class="checkbox common-category-field">
                            <input type="checkbox" name="categories[]" value="{{$key}}" class="publish-checkbox">
                            <span class="common-category-font pull-right">{{$value}}</span>
                        </label>
                    </li>
                    <hr class="common-category-hr">
                @endforeach
            </ul>

            @yield('categories_error')
        </div>
    </div>

    {{--<div class="row">--}}
        {{--Buttons - located under input fields, on the left side--}}
        {{--<div class="col-xs-8 news-add-submit-center">--}}
            {{--<button type="submit" class="btn btn-primary submit-button">Добавить</button>--}}
        {{--</div>--}}
        {{--<div class="col-xs-4">&nbsp;</div>--}}
    {{--</div>--}}
    </form>
</div>

@stop
