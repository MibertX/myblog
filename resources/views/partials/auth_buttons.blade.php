@if(Auth::check())
    <form action="{{route('logout')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{Auth::user()->name}}
        <button type="submit" class="btn btn-info">
            Exit
        </button>
    </form>
@else
    <button class="btn btn-success">
        <a href="{{route('login')}}">{{trans('nav.login')}}</a>
    </button>
    <button class="btn btn-info">
        <a href="{{route('getRegister')}}">{{trans('nav.reg')}}</a>
    </button>
@endif
