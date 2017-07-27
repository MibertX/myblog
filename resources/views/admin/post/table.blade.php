@foreach($posts as $post)
    <tr {{ !$post->seen? 'class=panel-warning' : '' }}>
        <td class="td-title">{!! $post->title !!}</td>
        <td>{{$post->username}}</td>
        <td class="td-date">{{$post->created_at}}</td>

        <td class="align-center">
            <input type="checkbox" name="seen" value="{{$post->post_id}}" {{$post->seen == 1 ? 'checked' : ''}}>
        </td>

        <td class="align-center">
            <input type="checkbox" name="active" value="{{$post->post_id}}" {{$post->active == 1 ? 'checked' : ''}}>
        </td>

        <td class="td-for-btn">
            <a href="{{route('getOne', ['id' => $post->post_id])}}" class="icon-extra">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>

        <td class="td-for-btn">
            <a href="{{route('updatePostView', ['id' => $post->post_id])}}" class="icon-edit">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>

        <td class="td-for-btn">
            <button type="button" name="delete" class="icon-delete" value="{{$post->post_id}}">
            {{--<a href="#" name="delete" class="icon-delete" value="{{$post->post_id}}">--}}
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                </span>
            {{--</a>--}}
            </button>
        </td>
    </tr>
@endforeach
    <tr>
        <td colspan="8" class="align-center">{!! $posts->render() !!}</td>
    </tr>