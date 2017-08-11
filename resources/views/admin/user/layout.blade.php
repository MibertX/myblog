@extends('admin.layout')

@section('headExtra')
    <link rel="stylesheet" href="/css/admin/table.css">
    <link rel="stylesheet" href="/css/user.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="/js/ajax/adminUsers.js"></script>


@section('admin-section')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="admin-title">Users management</h2>
            @if(request()->path() != 'adminzone/users/create')
                <button class="btn-admin-action" role="button">
                    <a href="{{route('createUserView')}}">
                        <i class="fa fa-plus"></i>&nbsp;
                        New User
                    </a>
                </button>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path no-user-select">
                <i class="fa fa-user"></i>
                <a href="{{route('createUserView')}}" class="{{request()->path() != 'adminzone/users/all' ? '' : 'link-disabled'}}">
                    Users
                </a>
                @yield('link-path')
            </span>
        </div>
    </div>
    @yield('admin-content')
@stop