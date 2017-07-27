@extends('admin.layout')

@section('headExtra')
    <link rel="stylesheet" href="/css/admin/table.css">

@section('admin-section')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="admin-title">Users management</h2>
            @if(request()->path() != 'adminzone/users/all')
                <button class="btn-admin-action" role="button">
                    <a href="#">New User</a>
                </button>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path no-user-select">
                <a href="#" class="{{request()->path() != 'adminzone/users/all' ? '' : 'link-disabled'}}">
                    Users
                </a>
                @yield('link-path')
            </span>
        </div>
    </div>
    @yield('admin-content')
@stop