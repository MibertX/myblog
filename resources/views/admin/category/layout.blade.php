@extends('admin.layout')

@section('headExtra')
    <link rel="stylesheet" href="/css/admin/categories.css">
    <link rel="stylesheet" href="/css/admin/table.css">
@section('admin-section')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="admin-title">{{trans('admin.category_section')}}</h2>
            @if(request()->path() != 'adminzone/categories/create')
                <button class="btn-admin-action" role="button">
                    <a href="{{route('categoryCreateView')}}">{{trans('admin.add_category')}}</a>
                </button>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path">@yield('link-path')</span>
        </div>
    </div>
    @yield('admin-content')
@stop


