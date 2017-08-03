@extends('admin.user.layout')



@section('admin-content')
    {{csrf_field()}}
    <table class="responsive-table">
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Last seen</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->updated_at ?: '-'}}</td>

                <td class="td-for-btn">
                    <button class="icon-action" role="button" type="submit" value="{{$user->user_id}}">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </td>

                <td class="td-for-btn">
                    <button class="icon-edit" role="button">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </td>

                <td class="td-for-btn">
                    <button class="icon-ban" role="button" name="delete" value="{{$user->user_id}}">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-square fa-stack-2x"></i>
                            @if ($user->ban == true)
                                <?php $icon_class = 'fa-unlock'?>
                            @else
                                <?php $icon_class = 'fa-ban'?>
                            @endif
                            <i class="fa {{$icon_class}} fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </td>

                <td class="td-for-btn">
                    <button class="icon-delete" role="button" name="delete">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
@endsection