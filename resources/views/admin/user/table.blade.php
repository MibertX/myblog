@can('toogleUserSeen', Auth::user())
    <?php $can_toogle_seen = true ?>
@endcan

@foreach($users as $user)
    <?php $user_can_be_banned = false; $user_can_be_deleted = false?>
    <tr class="{{!$user->seen ? 'panel-info' : ''}} {{$user->ban ? 'panel-warning' : ''}}">
        <td>{{$user->name}}</td>
        <td>{{$user->role}}</td>
        @if (isset($can_toogle_seen))
            <td class="text-center">
                <input type="checkbox" name="seen" {{$user->seen ? 'checked' : ''}} value="{{$user->user_id}}">
            </td>
        @endif

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

        @can('toogleUserBan', $user)
            <?php $user_can_be_banned = true ?>
        @endcan
        <td class="td-for-btn">
            <button role="button" name="delete" value="{{$user->user_id}}"
                    class="icon-ban {{$user->ban ? 'icon-unlock' : ''}} {{!$user_can_be_banned ? 'icon-disabled' : ''}}">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>

                    <i class="fa {{$user->ban ? 'fa-unlock' : 'fa-ban'}} fa-stack-1x fa-inverse"></i>
                </span>
            </button>
        </td>

        @can('deleteUser', $user)
            <?php $user_can_be_deleted = true ?>
        @endcan
        <td class="td-for-btn">
            <button role="button" name="delete" value="{{$user->user_id}}"
                    class="icon-delete {{!$user_can_be_deleted ? 'icon-disabled' : ''}}" >
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