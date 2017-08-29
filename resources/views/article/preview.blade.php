<div class="preview-container">
    <div class="row">
        <div class="col-xs-2 preview-short-date">
            <div class="preview-day">
                {{date('j', strtotime($article->created_at))}}
            </div>
            <div class="preview-month">
                {{date('M', strtotime($article->created_at))}}
            </div>
        </div>

        <div class="col-xs-10 preview-article-info">
            @if(!$article->showFull)
                <a class="preview-title" href="{{!$article->showFull ? route('getOne', ['id' => $article->post_id]) : '#'}}">
                    {!! $article->title !!}
                </a>
            @else
                <span class="preview-title">
                    {!! $article->title !!}
                </span>
            @endif

            <div class="preview-details">
                <span class="preview-user-info">
                    <span class="{{$article->userbanned ? 'banned' : $article->userrole}}-color">
                        {{$article->userbanned ? trans('users.banned') : trans('users.' . $article->userrole)}}
                    </span>

                    <button class="user-window" value="{{$article->user_id}}" role="button" type="submit">
                        <i class="fa fa-user"></i>
                        <span>{{$article->username}}</span>
                    </button>
                </span>

                <span class="preview-date-info">
                    <i class="fa fa-calendar"></i>
                    {{$article->date}}
                </span>

                <span class="preview-post-categories">
                    <i class="fa fa-tags"></i>
                    @foreach($article->categories as $category)
                        <a href="{{route('getByCategories', ['category' => $category->name])}}">
                            {{strtr($category->name, trans('posts.categories'))}}
                        </a>/
                    @endforeach
                </span>
            </div>
        </div>
    </div>

    <hr class="preview-hr">

    <div class="row">
        <div class="col-xs-12">
            <span class="preview-text">
                {!! $content !!}
            </span>
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