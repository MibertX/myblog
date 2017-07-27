@extends('admin.layout')
@section('headExtra')
    <link rel="stylesheet" href="/css/admin/posts.css">
    <link rel="stylesheet" href="/css/admin/table.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="/js/ajax/pagination.js"></script>

    @yield('summernote')
    @yield('ajax')
@section('admin-section')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="admin-title">{{trans('admin.posts.gestion')}}</h2>
            @if(request()->path() != 'adminzone/posts/create')
                <button class="btn-admin-action" role="button">
                    <a href="{{route('createPostView')}}">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        {{trans('admin.posts.create_btn')}}
                    </a>
                </button>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path no-user-select">
                <i class="fa fa-file-text-o"></i>
                <a href="{{route('adminPostsView')}}" class="{{request()->path() != 'adminzone/posts/all' ? '' : 'link-disabled'}}">
                    {{trans('admin.posts.link')}}
                </a>
                @yield('link-path')
            </span>
        </div>
    </div>
    @yield('admin-content')
@stop
