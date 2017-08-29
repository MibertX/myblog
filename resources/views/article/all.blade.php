@extends('article.layout')

@section('title')
    {{trans('posts.title.all')}}
    @stop

@section('posts')
    @if (count($articles) < 1)
        <p id="preview-no-posts-text">
            {{trans('posts.no_posts')}}
        </p>
    @else
        @foreach($articles as $article)
            @include('article/preview', ['content' => $article->preview])
        @endforeach
        <hr class="preview-hr-solid">

        {{--Page navigation's buttons--}}
        <div class="wrapper">{{ $articles->render() }}</div>
    @endif
@stop