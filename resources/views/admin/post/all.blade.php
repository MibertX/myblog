@extends('admin.post.layout')

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

            @can('tooglePostSeen', Auth::user())
            <th class="align-center">Seen
                <a href="#" name="posts.seen" class="order"><i class="fa fa-sort"></i></a>
            </th>
            @endcan

            @can('tooglePostActive', Auth::user())
            <th class="align-center">Active
                <a href="#" name="posts.active" class="order"><i class="fa fa-sort"></i></a>
            </th>
            @endcan
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @include('admin.post.table')
        </tbody>
        {{--<tr><input type="checkbox" class="toogle-seen" value="41" id="toogle"></tr>--}}
    </table>
    {{--{{$posts->links()}}--}}
@endsection