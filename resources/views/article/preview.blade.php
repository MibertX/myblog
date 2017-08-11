<div class="preview-container">
    <div class="row">
        <div class="col-xs-2 preview-short-date">
            <div class="preview-day">
                {{$article->short_day}}
            </div>
            <div class="preview-month">
                {{$article->short_month}}
            </div>
        </div>

        <div class="col-xs-10 preview-article-info">
            <span class="preview-title">{!! $article->title !!}</span>
            <p class="preview-details">
                <button class="icon-action" name="delete" value="{{$article->user_id}}" role="button" type="submit">
                    {{$article->username}}
                </button>
                &nbsp;{{trans('posts.added')}}&nbsp;{{$article->created_at}}
            </p>
        </div>
    </div>

    <hr class="preview-hr">

    <div class="row">
        <div class="col-xs-12">
            <p class="preview-text">
                @foreach($article->categories as $category)
                    <a href="">{{$category->name}}</a><span>/</span>
                @endforeach
                {!! $content !!}
            </p>
        </div>
    </div>

    @if(!$article->showFull)
    <div class="row">
        <div class="col-xs-12">
            <span class="pull-right preview-link">
                <a href="{{route('getOne', ['id' => $article->post_id])}}">{{trans('posts.read_more')}}</a>
                <span>&raquo;</span>
            </span>
        </div>
    </div>
    @endif
</div>