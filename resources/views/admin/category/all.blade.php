@extends('admin.category.layout')

@section('link-path')
    {{trans('admin.categories')}}
@stop

@section('admin-content')
    <table class="responsive-table">
        <tr>
            <th>{{trans('admin.category_table.name')}}</th>
            <th class="text-center">{{trans('admin.category_table.posts')}}</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>


        @foreach($categories as $category)
            <tr>
                <td class="table-row-name">{{trans('categories.' . $category->name)}}</td>
                <td class="text-center">{{$category->posts}}</td>
                <td>
                    <button class="btn-extra" role="button">
                        <a href="{{route('getByCategories', ['category' => $category->name])}}">{{trans('admin.see_posts_btn')}}</a>
                    </button>
                </td>
                <td >
                    <button class="btn-edit" role="button">
                        <a href="{{route('categoryUpdateView', array('id' => $category->category_id))}}">{{trans('admin.edit_btn')}}</a>
                    </button>
                </td>
                <td>
                    {{--<button class="btn-category-delete">--}}
                        {{--<a href="{{route('categoryDelete', array('id' => $category->category_id))}}">{{trans('admin.delete_btn')}}</a>--}}
                    {{--</button>--}}
                    <form action="{{route('categoryDelete')}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$category->category_id}}" name="category_id">

                        <input type="submit" class="btn-delete" value="{{trans('admin.delete_btn')}}">
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
@stop
