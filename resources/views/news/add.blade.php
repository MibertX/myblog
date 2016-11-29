@extends('layout')


@section('title')
    Добавить новость
    @stop


@section('content')

<div class="container padding-container">
    {{ Form::open(array('url'    => action('NewsController@postAdd'),
            'method' => 'post',
            'role'   => 'form',
            'class'  => 'form-vertical '
    )) }}
    <div class="row">
        <div class="col-xs-8 background-news">
            <div class="form-group">
                <label for="title" class="control-label news-add-label">Название статьи</label>
                {{ Form::text('title', null, array('class'       => 'form-control news-add-field',
                                                   'placeholder' => 'Введите название статьи',
                )) }}
            </div>

            <div class="form-group">
                <label for="text" class="control-label news-add-label">Текст статьи</label><br>
                {{ Form::textarea('text', null, array('class'       => 'form-control news-add-field',
                                                      'placeholder' => 'Введите текст статьи',
                                                      'rows' => '32',
                )) }}
            </div>
        </div>

        <div class="col-xs-4 news-add-categories-padding">
            <div class="form-group ">
                <lavel for="categories" class="control-label">
                    <p class="news-add-checkbox-title">Категории</p>
                </lavel>
                @foreach(\App\News::$categories as $key=>$value)
                    <label class="checkbox news-add-checkbox">
                        {{ Form::checkbox($key, $value) }} <span class="pull-right">{{$value}}</span>
                    </label>
                    <hr class="hr-custom">
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8 news-add-submit-center">
            <button type="submit" class="btn btn-primary submit-button">Добавить</button>
        </div>
        <div class="col-xs-4">&nbsp;</div>
    </div>

    {{ Form::close() }}
</div>

@stop
