@extends('admin.layout')

@section('admin-section')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="admin-title">Dasboard</h2>
        </div>
    </div>
    <hr class="admin-hr dashboard-hr-color">

    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path dashboard-bgcolor-transparent">
                <i class="fa fa-dashboard"></i>
                <a href="{{route('adminPostsView')}}" class="{{request()->path() != 'adminzone/dashboard' ? '' : 'link-disabled'}}">
                    Dashboard
                </a>
                @yield('link-path')
            </span>
        </div>
    </div>
    @yield('admin-content')
@stop
