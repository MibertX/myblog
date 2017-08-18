@extends('admin.comments.layout')

@section('admin-content')
    {{csrf_field()}}
    <div id="comments-container">
        @include('admin.comments.preview', ['comments' => $comments])
    </div>
@stop