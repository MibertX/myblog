@extends('admin.dashboard.layout')

@section('headExtra')
    <link href="/css/admin/dashboard.css" rel="stylesheet">
    @endsection

@section('admin-content')
    <div class="row">
        <div class="col-xs-4 col-md-3">
            <a href="{{route('adminCategories')}}" class="card" id="categories">
                <div class="card-top">
                    <i class="fa fa-tags fa-inverse"></i>
                </div>
                <div class="card-bottom">
                    <span class="card-title">CATEGORIES</span>
                    <span class="new">{{$new_categories}} new</span>
                </div>
            </a>
        </div>

        <div class="col-xs-4 col-md-3">
            <a href="{{route('allUsers')}}" class="card" id="users">
                <div class="card-top">
                    <i class="fa fa-users fa-inverse"></i>
                </div>
                <div class="card-bottom">
                    <span class="card-title">USERS</span>
                    <span class="new">{{$new_users}} new</span>
                </div>
            </a>
        </div>

        <div class="col-xs-4 col-md-3">
            <a href="{{route('adminPostsView')}}" class="card" id="posts">
                <div class="card-top">
                    <i class="fa fa-pencil fa-inverse"></i>
                </div>
                <div class="card-bottom">
                    <span class="card-title">POSTS</span>
                    <span class="new">{{$new_posts}} new</span>
                </div>
            </a>
        </div>

        <div class="col-xs-4"></div>
    </div>
    @stop