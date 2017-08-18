<div class="comment-container">
    <div class="row">
        <div class="col-xs-4 col-md-3 {{$comment->role}}-color">
            <h3>{{$comment->username}}</h3>
            <h4>{{$comment->role}}</h4>
        </div>
        <div class="col-xs-8 col-md-9">
            <div>{{$comment->created_at}}</div>
            <hr>
            <div>{!! $comment->text !!}</div>
        </div>
    </div>
</div>