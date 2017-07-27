@extends('admin.user.layout')

@section('admin-content')
    <table class="responsive-table">
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->role}}</td>
                <td>
                    <form action="#" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$user->user_id}}" name="post_id">
                        {{--<input type="submit" class="btn-delete" value="{{trans('admin.delete_btn')}}">--}}
                        <button class="btn-extra" role="button" type="submit">
                            <a href="#">{{trans('admin.posts.see_btn')}}</a>
                        </button>
                    </form>

                </td>
                <td>
                    <button class="btn-edit" role="button">
                        <a href="#">{{trans('admin.edit_btn')}}</a>
                    </button>
                </td>
                <td>
                    <form action="#" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$user->user_id}}" name="post_id">

                        <input type="submit" class="btn-delete" value="{{trans('admin.delete_btn')}}">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection