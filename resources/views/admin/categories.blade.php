@extends('admin.layout')

@section('headExtra')
    <link rel="stylesheet" href="/css/admin/categories.css">

@section('admin-title')
    {{--<div class="row">--}}
        {{--<div class="col-xs-8">--}}
            {{--<h2>Categoires</h2>--}}
        {{--</div>--}}
        {{--<div class="col-xs-4">--}}
            {{--<button class="btn-add-post" role="button">--}}
                {{--<a href="{{route('categoryCreateView')}}">add_post</a>--}}
            {{--</button>--}}
        {{--</div>--}}
    {{--</div>--}}
    @include('admin.titles.categories-title')
    @stop

@section('admin-content')
        <table class="responsive-table">
            <tr>
                <th>Name</th>
                <th>Posts</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>


            @foreach($categories as $category)
                <tr>
                    <td class="table-row-name">{{$category->name}}</td>
                    <td>1234567</td>
                    <td>
                        <button class="btn-extra" role="button">
                            <a href="">see_posts</a>
                        </button>
                    </td>
                    <td >
                        <button class="btn-edit" role="button">
                            <a href="{{route('categoryUpdateView', array('id' => $category->category_id))}}">change</a>
                        </button>
                    </td>
                    <td>
                        <button class="btn-delete">
                            <a href="{{route('categoryDelete', array('id' => $category->category_id))}}">delete</a>
                        </button>
                    </td>
                </tr>
            @endforeach

        </table>

        {{--</div>--}}
        {{--@endforeach--}}


        {{--<div class="col-xs-4">--}}
                {{--<div class="category-container">--}}
                    {{--<div class="col-xs-12 category-card-top">--}}
                        {{--{{$category->name}}--}}
                    {{--</div>--}}

                    {{--<div class="col-xs-12 category-card-bottom">--}}
                        {{--<div class="col-xs-12">--}}
                            {{--see posts--}}
                            {{--<button class="btn-category-delete">--}}
                                {{--<a href="{{route('categoryDelete', array('id' => $category->category_id))}}">delete</a>--}}
                            {{--</button>--}}
                            {{--<button class="btn-category-change">--}}
                                {{--<a href="{{route('categoryUpdateView', array('id' => $category->category_id))}}">change</a>--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}





@stop
