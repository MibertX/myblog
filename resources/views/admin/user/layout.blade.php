@extends('admin.layout')

@section('section_head_extra')
    <link rel="stylesheet" href="/css/user.css">
    <script src="/js/ajax/adminUsers.js"></script>
@endsection

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
    <hr class="admin-hr user-hr-color">
    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path user-bgcolor-transparent">
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