@extends('article.layout')

@section('post')
    @include('article/preview', array('content'=>$article->content))
    <h2 id="comments-title">Коментарии</h2>
    <button id="comment-btn">New comment</button>

    <form action="" method="post" enctype="multipart/form-data" id="comment-form">
        <textarea name="text" placeholder="What do you think about this?"></textarea>
    </form>
    <div id="comments">
        @foreach($comments as $comment)
            @include('comment', array('comment'=> $comment))
        @endforeach
    </div>
@stop