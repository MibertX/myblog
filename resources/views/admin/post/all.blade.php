@extends('admin.post.layout')

@section('ajax')
    <script src="/js/ajax/adminPosts.js"></script>
    @endsection

@section('admin-content')
    {{csrf_field()}}
    <table class="responsive-table">
        <thead>
        <tr>
            <th>{{trans('admin.posts.title')}}
                <a href="#" name="posts.title" class="order"><i class="fa fa-sort"></i></a>
            </th>

            <th>{{trans('admin.posts.author')}}
                <a href="#" name="username" class="order"><i class="fa fa-sort"></i></a>
            </th>

            <th>{{trans('admin.posts.date')}}
                <a href="#" name="posts.created_at" class="order"><i class="fa fa-sort fa-sort-desc"></i></a>
            </th>

            <th class="align-center">Seen
                <a href="#" name="posts.seen" class="order"><i class="fa fa-sort"></i></a>
            </th>

            <th class="align-center">Active
                <a href="#" name="posts.active" class="order"><i class="fa fa-sort"></i></a>
            </th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @include('admin.post.table')
        </tbody>
        {{--<tr><input type="checkbox" class="toogle-seen" value="41" id="toogle"></tr>--}}
    </table>
    {{--{{$posts->links()}}--}}
@endsection