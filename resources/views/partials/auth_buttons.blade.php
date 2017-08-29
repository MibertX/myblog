@if(Auth::check())
    <div class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i>
            {{Auth::user()->name}}
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <form action="{{route('logout')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <button type="submit" class="btn btn-logout">
                    <i class="fa fa-sign-out"></i>
                    {{trans('nav.logout')}}
                </button>
                </form>
            </li>
        </ul>
    </div>
@else
    {{--<button class="btn btn-success" type="submit" role="link">--}}
        <a class="btn btn-success" href="{{route('login')}}">
            <i class="fa fa-sign-in"></i>
            {{trans('nav.login')}}
        </a>
    {{--</button>--}}
    {{--<button class="btn btn-info">--}}
        {{--<a href="{{route('getRegister')}}">{{trans('nav.reg')}}</a>--}}
    {{--</button>--}}
@endif
