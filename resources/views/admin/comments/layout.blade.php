@extends('admin.layout')

@section('section_head_extra')
    <link rel="stylesheet" href="/css/comment.css">
    <script src="/js/ajax/adminComments.js"></script>
@endsection

@section('admin-section')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="admin-title">Comments management</h2>
        </div>
    </div>
    <hr class="admin-hr comments-hr-color">

    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path comments-bgcolor-transparent">
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


