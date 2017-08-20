@can('toogleCommentSeen', Auth::user())
    <?php $can_toogle_seen = true ?>
@endcan

@can('toogleCommentValid', Auth::user())
    <?php $can_toogle_valid = true ?>
@endcan

@can('deleteComment', Auth::user())
    <?php $button_delete_class = 'icon-delete' ?>
@else
    <?php $button_delete_class = 'icon-disabled'?>
@endcan

@foreach($comments as $comment)
    <div class="row">
        <div class="col-xs-12 ">
            <div class="panel
            {{!$comment->valid && isset($can_toogle_valid) ? 'panel-warning' : ''}}
            {{!$comment->seen && isset($can_toogle_seen) ? 'panel-info' : ''}}">
                <div class="panel-heading">
                    <table class="comments-table">
                        <thead>
                        <tr>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Post</th>
                            <th class="text-center">
                                {{isset($can_toogle_seen) ? 'Seen' : ''}}
                            </th>
                            <th class="text-center">
                                {{isset($can_toogle_valid) ? 'Valid' : ''}}
                            </th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$comment->username}}</td>
                            <td>{{$comment->created_at}}</td>
                            <td>{!! $comment->title !!}</td>

                            @if (isset($can_toogle_seen))
                                <td class="text-center">
                                    <input type="checkbox" name="seen" value="{{$comment->comment_id}}" {{!$comment->seen ? '' : 'checked'}}>
                                </td>
                            @endif

                            @if (isset($can_toogle_valid))
                                <td class="text-center">
                                    <input type="checkbox" name="valid" value="{{$comment->comment_id}}" {{!$comment->valid ? '' : 'checked'}}>
                                </td>
                            @endif

                            <td class="td-for-btn">
                                <button class="{{$button_delete_class}}" name="delete" value="{{$comment->comment_id}}">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
                                    </span>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="panel-body">
                    {!! $comment->text !!}
                </div>
            </div>
        </div>
    </div>
@endforeach
{{$comments->render()}}