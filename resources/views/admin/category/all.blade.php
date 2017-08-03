@extends('admin.category.layout')

@section('link-path')
    {{trans('admin.categories')}}
@stop

@section('admin-content')
    {{csrf_field()}}
    <table class="responsive-table">
        <thead>
        <tr>
            <th>{{trans('admin.category_table.name')}}
                <a href="#" name="categories.name" class="order"><i class="fa fa-sort fa-sort-asc"></i></a>
            </th>
            <th class="text-center">{{trans('admin.category_table.posts')}}
                <a href="#" name="posts" class="order"><i class="fa fa-sort"></i></a>
            </th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @include('admin.category.table')
        </tbody>
    </table>
@stop
