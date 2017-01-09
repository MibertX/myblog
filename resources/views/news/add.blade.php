@extends('layout')


@section('title')
    Добавить новость
    @stop

@section('headExtra')
    <link href="/bootstrap/css/custom-news.css" rel="stylesheet">
    @stop


@section('content')
<div class="container padding-container">
    {{--Making sections for error-messages of each form field if it exists--}}
    @if ($errors->all())
        @foreach($errors->keys() as $error_key)
            @section($error_key . '_error')
                <div class="error-info">
                    <p>* {{$errors->first($error_key)}}</p>
                </div>
            @stop
        @endforeach
    @endif

    {{ Form::open(array(
            'url'    => action('NewsController@postAdd'),
            'method' => 'post',
            'role'   => 'form',
            'class'  => 'form-vertical '
    )) }}
    <div class="row">
        {{--Left side of the form - input fields--}}
        <div class="col-xs-8 background-news">
            <div class="form-group">
                <label for="title" class="control-label news-add-label">Название статьи</label>
                {{ Form::text('title', null, array('class'       => 'form-control news-add-field',
                                                   'placeholder' => 'Введите название статьи',
                )) }}
                @yield('title_error')
            </div>

            <div class="form-group">
                <label for="text" class="control-label news-add-label">Текст статьи</label><br>
                {{ Form::textarea('text', null, array('class'       => 'form-control news-add-field',
                                                      'placeholder' => 'Введите текст статьи',
                                                      'rows' => '32',
                )) }}
                @yield('text_error')
            </div>
        </div>

        {{--Right side of the form - checkboxes for selecting categories--}}
        <div class="col-xs-4 news-add-categories-padding">
            <div class="form-group ">
                <p class="news-add-checkbox-title">Категории</p>

                @foreach(\App\News::$categories as $key=>$value)
                    <label class="checkbox news-add-checkbox-field">
                        {{ Form::checkbox($key, $value, null, array('class' => 'news-add-checkbox')) }}
                        <span class="pull-right">{{$value}}</span>
                    </label>
                    <hr class="hr-custom">
                @endforeach
                @yield('categories_error')
            </div>
        </div>
    </div>

    <div class="row">
        {{--Buttons - located under input fields, on the left side--}}
        <div class="col-xs-8 news-add-submit-center">
            <button type="submit" class="btn btn-primary submit-button">Добавить</button>
        </div>
        <div class="col-xs-4">&nbsp;</div>
    </div>

    {{ Form::close() }}
</div>

@stop
