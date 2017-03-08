<div class="row row-pad">
    <div class="col-xs-2 short-date">
        <div class="day">
            {{$article->short_day}}
        </div>
        <div class="month">
            {{$article->short_month}}
        </div>
    </div>

    <div class="col-xs-10">
        <span class="title">{{$article->title}}</span>
        <p class="information">{{$article->author}} &nbsp; {{$article->date}}</p>
    </div>
</div>

<div class="row row-pad">
    <div class="col-xs-12 no-padding">
        <p class="preview-text">{{$article->text}}</p>
    </div>
</div>

<div class="row row-pad">
        <span class="pull-right link-font">
            <a href="">Читать далее</a> &raquo;
        </span>
</div>
<hr class="hr-preview">