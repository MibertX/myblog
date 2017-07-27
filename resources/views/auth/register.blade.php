@extends('main_layout')

@section('title')
    Регистрация
@stop

@section('headExtra')
    <link href="/css/auth/register.css" rel="stylesheet">
@stop

@section('content')
    <div class="container">
        <form accept-charset="utf-8"
              action="{{ route('postRegister') }}"
              role="form"
              method="post"
              class="form-vertical reg-form col-xs-8 col-xs-offset-2"
              enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <div class="row reg-background-field">
                        <input type="text" name="name" id="name" value="{{old('name')}}"
                               class="col-xs-8 col-xs-push-4 reg-input-field
                                {{$errors->has('name')
                                    ? ' has-error'
                                    : (old('name') ? ' no-error' : '')}}"
                        >
                        <label for="name" class= "col-xs-4 col-xs-pull-8 reg-label-field">
                            {{trans('auth.name')}}
                        </label>
                    </div>
                    @if($errors->has('name'))
                        @include('partials.register_error', ['message' => $errors->first('name')])
                    @else
                        <div class="empty-error"></div>
                    @endif
                    {{--@include('partials.register_error', ['message' => 'test message'])--}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <div class="row reg-background-field">
                        <input type="email" name="email" id="email"
                               class="col-xs-8 col-xs-push-4 reg-input-field
                               {{$errors->has('email')
                                    ? ' has-error'
                                    : (old('email') ? ' no-error' : '')}}"
                        >
                        <label for="email" class= "col-xs-4 col-xs-pull-8 reg-label-field">
                            {{trans('auth.email')}}
                        </label>
                    </div>
                    @if($errors->has('email'))
                        @include('partials.register_error', ['message' => $errors->first('email')])
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
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-12">
                    <div class="row reg-background-field">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="col-xs-8 col-xs-push-4 reg-input-field
                               {{$errors->has('password_confirmation')
                                    ? ' has-error'
                                    : (old('password_confirmation') ? ' no-error' : '')}}"
                        >

                        <label for="password_confirmation" class= "col-xs-4 col-xs-pull-8 reg-label-field half-line-height">
                            {{trans('auth.pass_conf')}}
                        </label>
                    </div>
                    @if($errors->has('password_confirmation'))
                        @include('partials.register_error', ['message' => $errors->first('password_confirmation')])
                    @else
                        <div class="empty-error"></div>
                    @endif
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

