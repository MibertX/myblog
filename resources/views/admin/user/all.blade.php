@extends('admin.user.layout')

@section('admin-content')
    {{csrf_field()}}
    <table class="responsive-table">
        <thead>
        <tr>
            <th>
                Name
                <a href="#" class="order" name="users.name"><i class="fa fa-sort fa-sort-asc"></i></a>
            </th>
            <th>
                Role
                <a href="#" class="order" name="role"><i class="fa fa-sort"></i></a>
            </th>
            <th class="text-center">
                Seen
                <a href="#" class="order" name="users.seen"><i class="fa fa-sort"></i></a>
            </th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tbody>
            @include('admin/user/table')
        </tbody>
    </table>
@endsection