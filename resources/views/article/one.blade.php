@extends('article.layout')

@section('post')
    @include('article/preview', array('content'=>$article->content))
@stop