@extends('admin.layout')

@section('section_head_extra')
    <link rel="stylesheet" href="/css/admin/posts.css">
    <script src="/js/ajax/adminPosts.js"></script>
    @yield('summernote')
@endsection


@section('admin-section')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="admin-title">{{trans('admin.posts.gestion')}}</h2>
            @if(request()->path() != 'adminzone/posts/create')
                @can('createPost', Auth::user())
                <button class="btn-admin-action" role="button">
                    <a href="{{route('createPostView')}}">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        {{trans('admin.posts.create_btn')}}
                    </a>
                </button>
                @endcan
            @endif
        </div>
    </div>
    <hr class="admin-hr posts-hr-color">
    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path posts-bgcolor-transparent">
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
