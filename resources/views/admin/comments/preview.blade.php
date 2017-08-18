@foreach($comments as $comment)
    <div class="row">
        <div class="col-xs-12 ">
            <div class="panel {{!$comment->valid ? 'panel-warning' : ''}} {{!$comment->seen ? 'panel-info' : ''}}">
                <div class="panel-heading">
                    <table class="comments-table">
                        <thead>
                        <tr>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Post</th>
                            <th class="text-center">Seen</th>
                            <th class="text-center">Valid</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$comment->username}}</td>
                            <td>{{$comment->created_at}}</td>
                            <td>{!! $comment->title !!}</td>

                            <td class="text-center">
                                <input type="checkbox" name="seen" value="{{$comment->comment_id}}" {{!$comment->seen ? '' : 'checked'}}>
                            </td>

                            <td class="text-center">
                                <input type="checkbox" name="valid" value="{{$comment->comment_id}}" {{!$comment->valid ? '' : 'checked'}}>
                            </td>

                            <td class="td-for-btn">
                                <button class="icon-delete" name="delete" value="{{$comment->comment_id}}">
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