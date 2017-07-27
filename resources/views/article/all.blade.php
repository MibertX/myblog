@extends('article.layout')

@section('title')
    {{trans('posts.title.all')}}
    @stop

@section('posts')
    @foreach($articles as $article)
        @include('article/preview', ['content' => $article->preview])
    @endforeach
    <hr class="preview-hr-dashed">

    {{--Page navigation's buttons--}}
    <div class="col-xs-12">
        <div class="wrapper">{{ $articles->render() }}</div>
    </div>
@stop