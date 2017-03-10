@extends('layout')

@section('title')
    Регистрация
    @stop

@section('headExtra')
    <link href="/css/user-registration.css" rel="stylesheet">
    @stop

@section('content')
    <div class="container ">
        @if ($errors->all())
            @foreach($errors->keys() as $error_key)
                @section($error_key . '_error')
                    <div class="error-info">
                        <p>* {{$errors->first($error_key)}}</p>
                    </div>
                @stop
        @endforeach
        @endif


    {{--{{ Form::open(array(--}}
         {{--'url'    => route('publish'),--}}
         {{--'method' => 'post',--}}
         {{--'role'   => 'form',--}}
         {{--'class'  => 'form-vertical col-xs-8 col-xs-offset-2 custom-container'--}}
    {{--)) }}--}}
    <form accept-charset="utf-8" action="{{route('publish')}}" role="form" method="post"
          class="form-vertical col-xs-8 col-xs-offset-2 custom-container" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="row margin-bottom">
            {{--<div class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3">--}}
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row row-background">
                    <input type="text" name="nickname" id="nickname" class="col-xs-8 col-xs-push-4 input-field">
                    <label for="nickname" class= "col-xs-4 col-xs-pull-8 label-field">
                        Имя
                    </label>

                    {{--{{ Form::text('login', null, array('class' => 'col-xs-8 col-xs-push-4 input-field', 'id' => 'login')) }}--}}
                    {{--{{ Form::label('login', null, array('class' => ' col-xs-4 col-xs-pull-8 label-field')) }}--}}
                </div>
            </div>
        </div>


        <div class="row margin-bottom">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row row-background">
                    <input type="text" name="login" id="login" class="col-xs-8 col-xs-push-4 input-field">
                    <label for="login" class= "col-xs-4 col-xs-pull-8 label-field">
                        Логин
                    </label>
                    {{--<div class="col-xs-4 label-field">--}}
                        {{--{{ Form::label('username', 'Логин', array('class' => 'control-label')) }}--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-8 input-field">--}}
                        {{--{{ Form::text('username', null, array('class' => 'form-control')) }}--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>


        <div class="row margin-bottom">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
            {{--<div class="col-xs-7 col-xs-offset-1 col-md-6 col-md-offset-2">--}}
                <div class="row row-background">
                    <input type="password" name="password" id="password" class="col-xs-8 col-xs-push-4 input-field">
                    <label for="password" class= "col-xs-4 col-xs-pull-8 label-field">
                        Пароль
                    </label>
                    {{--<div class="col-xs-4 label-field">--}}
                        {{--{{ Form::label('password', 'Пароль', array('class' => 'control-label')) }}--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-8 input-field">--}}
                        {{--{{ Form::password('password', array('class' => 'form-control')) }}--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>


        <div class="row margin-bottom">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row row-background">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="col-xs-8 col-xs-push-4 input-field">
                    <label for="password_confirmation" class= "col-xs-4 col-xs-pull-8 label-field half-line-height">
                        Проверка пароля
                    </label>


                    {{--<div class="col-xs-4 label-field half-line-height">--}}
                        {{--{{ Form::label('password_confirmation', 'Проверка пароля',--}}
                                       {{--array('class' => 'control-label')) }}--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-8 input-field">--}}
                        {{--{{ Form::password('password_confirmation', array('class' => 'form-control')) }}--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>


        <div class="row margin-bottom">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row row-background">
                    <input type="email" name="email" id="email" class="col-xs-8 col-xs-push-4 input-field">
                    <label for="email" class= "col-xs-4 col-xs-pull-8 label-field">
                        E-Mail
                    </label>

                    {{--<div class="col-xs-4 label-field">--}}
                        {{--{{ Form::label('email', 'E-Mail', array('class' => 'control-label')) }}--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-8 input-field">--}}
                        {{--{{ Form::email('email', null, array('class' => 'form-control')) }}--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>


        <div class="row">
            {{--<div class="col-xs-6">--}}

            {{--</div>--}}
            {{--<div class="col-xs-6">--}}
                {{--<button type="reset" class="btn btn-primary pull-left">Reset</button>--}}
            {{--</div>--}}
            <div class="col-xs-12">
                <div class="wrapper-reg">

                        <button type="submit" class="btn btn-success btn-custom">Отправить</button>
                        <button type="reset" class="btn btn-warning btn-custom">Сбросить</button>

                </div>
            </div>
        </div>
    </form>
            {{--{{ Form::close() }}--}}
    </div>
    @stop
