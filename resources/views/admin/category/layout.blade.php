@extends('admin.layout')

@section('section_head_extra')
    <link rel="stylesheet" href="/css/admin/categories.css">
    <script src="/js/ajax/adminCategories.js"></script>
@endsection

@section('admin-section')
    <div class="row">
        <div class="col-xs-12">
            <h2 class="admin-title">{{trans('admin.category_section')}}</h2>
            @if(request()->path() != 'adminzone/categories/create')
                @can('createCategory', Auth::user())
                    <button class="btn-admin-action" role="button">
                        <a href="{{route('categoryCreateView')}}">
                            <i class="fa fa-plus"></i>
                            &nbsp;{{trans('admin.add_category')}}
                        </a>
                    </button>
                @endcan
            @endif
        </div>
    </div>
    <hr class="admin-hr categories-hr-color">
    <div class="row">
        <div class="col-xs-12">
            <span class="admin-link-path categories-bgcolor-transparent">
                <i class="fa fa-tags"></i>
                @yield('link-path')
            </span>
        </div>
    </div>
    @yield('admin-content')
@stop


