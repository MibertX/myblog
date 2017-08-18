@extends('admin.layout')

@section('headExtra')
    <link rel="stylesheet" href="/css/admin/table.css">
    <link rel="stylesheet" href="/css/comment.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="/js/ajax/adminComments.js"></script>

@section('admin-section')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="admin-title">Comments management</h2>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path">
                <i class="fa fa-comments"></i>
                <a href="{{route('adminComments')}}" class="{{request()->path() != 'adminzone/comments/all' ? '' : 'link-disabled'}}">
                    Comments
                </a>
                @yield('link-path')
            </span>
        </div>
    </div>
    @yield('admin-content')
@stop


