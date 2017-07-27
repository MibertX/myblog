@extends('admin.category.layout')

@section('link-path')
    <a href="{{route('adminCategories')}}">{{trans('admin.categories')}}</a>&nbsp;/&nbsp;{{trans('admin.creation')}}
@stop

@section('admin-content')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{route('categoryCreate')}}" method="post" enctype="multipart/form-data" class="category-create-form">
                {{csrf_field()}}
                <div class="form-group">
                    {{--<label for="name">{{trans('admin.new_category_name')}}</label>--}}
                    {{--<input type="text" name="name" id="name">--}}

                    <label for="name-ru">{{trans('admin.new_category_name') . '  ru'}}</label>
                    <input type="text" name="name_ru" id="name_ru">

                    <label for="name-en">{{trans('admin.new_category_name') . '  en'}}</label>
                    <input type="text" name="name_en" id="name_en">
                </div>
                <input type="submit" class="btn-category-submit" value="{{trans('admin.submit')}}">
            </form>
        </div>
    </div>
    @stop