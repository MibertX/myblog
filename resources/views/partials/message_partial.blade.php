<div class="message-{{$type}} popup-msg">

    <div class="row">
        <div class="col-xs-12">
            <h4>{{strtoupper($type)}}</h4>
            <button id="close-popup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            {{$message}}
        </div>
    </div>
</div>

