@extends('main_layout')

@section('title')
    Аутенфикация
@stop

@section('headExtra')
    <link href="/css/auth/register.css" rel="stylesheet">
@stop

@section('content')
    <div class="container">
        <form accept-charset="utf-8"
              action="{{ action('Auth\LoginController@login') }}"
              role="form"
              method="post"
              class="form-vertical reg-form col-xs-8 col-xs-offset-2"
              enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <div class="row reg-background-field">
                        <input type="text" name="login" id="login" value="{{old('login')}}"
                               class="col-xs-8 col-xs-push-4 reg-input-field
                                {{$errors->has('login')
                                    ? ' has-error'
                                    : (old('name') ? ' no-error' : '')}}"
                        >
                        <label for="login" class= "col-xs-4 col-xs-pull-8 reg-label-field">
                            <span title="{{trans('auth.login_help')}}">{{trans('auth.login')}}</span>
                        </label>
                    </div>

                    @if($errors->has('login'))
                        @include('partials.register_error', ['message' => $errors->first('login')])
                    @else
                        <div class="empty-error"></div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <div class="row reg-background-field">
                        <input type="password" name="password" id="password"
                               class="col-xs-8 col-xs-push-4 reg-input-field
                               {{$errors->has('password')
                                    ? ' has-error'
                                    : (old('password') ? ' no-error' : '')}}"
                        >
                        <label for="password" class= "col-xs-4 col-xs-pull-8 reg-label-field">
                            {{trans('auth.pass')}}
                        </label>
                    </div>

                    @if($errors->has('password'))
                        @include('partials.register_error', ['message' => $errors->first('password')])
                    @else
                        <div class="empty-error"></div>
                    @endif

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                        {{trans('auth.forget_pass')}}
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="wrapper">
                    <button type="submit" class="btn btn-success reg-btn">
                        {{trans('auth.send')}}
                    </button>
                    <button type="reset" class="btn btn-warning reg-btn">
                        {{trans('auth.reset')}}
                    </button>
                </div>
            </div>

        </form>
    </div>
@stop

