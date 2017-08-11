@foreach($users as $user)
    <tr class="{{!$user->seen ? 'panel-warning' : ''}}">
        <td>{{$user->name}}</td>
        <td>{{$user->role}}</td>

        <td class="text-center">
            <input type="checkbox" name="seen" {{$user->seen ? 'checked' : ''}} value="{{$user->user_id}}">
        </td>

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
            <button class="icon-delete" role="button" name="delete" value="{{$user->user_id}}">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
                </span>
            </button>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="7">{{$users->render()}}</td>
</tr>