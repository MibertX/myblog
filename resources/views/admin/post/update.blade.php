@extends('admin.post.layout')

@section('link-path')
    &nbsp;/&nbsp; Editing
@endsection

@section('admin-content')
    <form action="{{route('updatePost')}}" enctype="multipart/form-data" method="post">
        {{csrf_field()}}
        <input type="hidden" name="post_id" value="{{$post->post_id}}">

        <div class="row">
            <div class="col-xs-8 col-md-9 col-lg-10">
                <label for="post-title" class="label-title no-user-select">{{trans('admin.posts.title')}}</label>
                <input type="text" name="title" id="post-title" value="{{old('title')?old('title'):$post->title}}">

                <label for="preview" class="label-title no-user-select">{{trans('admin.posts.preview')}}</label>
                <textarea id="preview" name="preview" style="display: none">{{old('preview') ? old('preview') : $post->preview}}</textarea>
                <script>
                    $(document).ready(function() {
                        $('#preview').summernote();
                    });
                </script>

                <label for="text" class="label-title no-user-select">{{trans('admin.posts.content')}}</label>
                <textarea id="text" name="text" style="display: none">{{old('text') ? old('text') : $post->content}}</textarea>
                <script>
                    $(document).ready(function() {
                        $('#text').summernote();
                    });
                </script>

                <div class="wrapper">
                    <button type="submit" class="btn btn-success publish-button">{{trans('admin.submit')}}</button>
                </div>
            </div>

            <div class="col-xs-4 col-md-3 col-lg-2">
                <label for="category-list" class="label-title no-user-select">{{trans('admin.categories')}}</label>
                <ul id="category-list" class="no-user-select">
                    @foreach($categories as $category)
                        <li>
                            <label>
                                <input type="checkbox" name="categories[]" value="{{$category->category_id}}" class="publish-checkbox"
                                @if(old('categories'))
                                    @if (in_array($category->category_id, old('categories')))
                                        {{'checked'}}
                                    @endif
                                @else
                                    @if($post->categories)
                                        @foreach($post->categories as $post_category)
                                            @if($post_category->category_id == $category->category_id)
                                                {{'checked'}}
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                                >
                                <span class="common-category-font pull-right">{{trans('categories.' . $category->name)}}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </form>
@stop