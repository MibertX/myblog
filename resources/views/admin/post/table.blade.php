@can('tooglePostSeen', Auth::user())
    <?php $can_toogle_seen = true ?>
@endcan

@can('tooglePostActive', Auth::user())
    <?php $can_toogle_active = true ?>
@endcan

@cannot('updatePost', Auth::user())
    <?php $button_update_disable = true ?>
@endcannot

@cannot('deletePost', Auth::user())
    <?php $button_delete_disable = true ?>
@endcannot

@foreach($posts as $post)
    <tr class="{{!$post->seen? 'panel-info' : '' }} {{!$post->active ? 'panel-warning' : ''}}">
        <td>{!! $post->title !!}</td>
        <td>{{$post->username}}</td>
        <td>{{date('d-m-Y H:i', strtotime($post->created_at))}}</td>

        @if (isset($can_toogle_seen))
        <td class="align-center">
            <input type="checkbox" name="seen" value="{{$post->post_id}}" {{$post->seen == 1 ? 'checked' : ''}}>
        </td>
        @endif

        @if (isset($can_toogle_active))
        <td class="align-center">
            <input type="checkbox" name="active" value="{{$post->post_id}}" {{$post->active == 1 ? 'checked' : ''}}>
        </td>
        @endif

        <td class="td-for-btn">
            <a href="{{route('getOne', ['id' => $post->post_id])}}" class="icon-extra">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>

        <td class="td-for-btn">
            <a href="{{route('updatePostView', ['id' => $post->post_id])}}"
               class="icon-edit {{isset($button_update_disable) ? 'icon-disabled' : ''}}">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>

        <td class="td-for-btn">
            <button type="button" name="delete" value="{{$post->post_id}}"
                    class="icon-delete {{isset($button_delete_disable) ? 'icon-disabled' : ''}}">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                </span>
            </button>
        </td>
    </tr>
@endforeach
    <tr>
        <td colspan="8" class="align-center">{!! $posts->render() !!}</td>
    </tr>