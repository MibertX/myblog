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
            <span class="preview-title">{{$article->title}}</span>
            <p class="preview-details">{{$article->author}} &nbsp; {{$article->date}}</p>
        </div>
    </div>

    <hr class="preview-hr">

    <div class="row">
        <div class="col-xs-12">
            <p class="preview-text">{{$article->text}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <span class="pull-right preview-link">
                <a href="">Читать далее</a> <span>&raquo;</span>
            </span>
        </div>
    </div>
</div>

<hr class="preview-hr-dashed">

