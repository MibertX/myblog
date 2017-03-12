@extends('main_layout')
@include('error_sections')

@section('title')
    Регистрация
@stop

@section('headExtra')
    <link href="/css/user/registration.css" rel="stylesheet">
@stop

@section('content')
    <div class="container">
    <form accept-charset="utf-8"
          action="{{ route('publish') }}"
          role="form"
          method="post"
          class="form-vertical reg-form col-xs-8 col-xs-offset-2"
          enctype="multipart/form-data">

        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row reg-background-field">
                    <input type="text" name="nickname" id="nickname"
                           class="col-xs-8 col-xs-push-4 reg-input-field">
                    <label for="nickname" class= "col-xs-4 col-xs-pull-8 reg-label-field">
                        Имя
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row reg-background-field">
                    <input type="text" name="login" id="login"
                           class="col-xs-8 col-xs-push-4 reg-input-field">
                    <label for="login" class= "col-xs-4 col-xs-pull-8 reg-label-field">
                        Логин
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row reg-background-field">
                    <input type="password" name="password" id="password"
                           class="col-xs-8 col-xs-push-4 reg-input-field">
                    <label for="password" class= "col-xs-4 col-xs-pull-8 reg-label-field">
                        Пароль
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row reg-background-field">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="col-xs-8 col-xs-push-4 reg-input-field">
                    <label for="password_confirmation" class= "col-xs-4 col-xs-pull-8 reg-label-field half-line-height">
                        Проверка пароля
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row reg-background-field">
                    <input type="email" name="email" id="email"
                           class="col-xs-8 col-xs-push-4 reg-input-field">
                    <label for="email" class= "col-xs-4 col-xs-pull-8 reg-label-field">
                        E-Mail
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="wrapper">
                <button type="submit" class="btn btn-success reg-btn">
                    Отправить
                </button>
                <button type="reset" class="btn btn-warning reg-btn">
                    Сбросить
                </button>
            </div>
        </div>

    </form>
    </div>
@stop
