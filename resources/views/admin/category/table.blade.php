@foreach($categories as $category)
    <tr>
        <td class="table-row-name">{{trans('categories.' . $category->name)}}</td>
        <td class="text-center">{{$category->posts}}</td>

        <td class="td-for-btn">
            <a href="{{route('getByCategories', ['category' => $category->name])}}" class="icon-extra">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>

        <td class="td-for-btn">
            <a href="{{route('categoryUpdateView', array('id' => $category->category_id))}}" class="icon-edit">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>
        <td class="td-for-btn">
            {{--<button class="btn-category-delete">--}}
            {{--<a href="{{route('categoryDelete', array('id' => $category->category_id))}}">{{trans('admin.delete_btn')}}</a>--}}
            {{--</button>--}}

            {{--<form action="{{route('categoryDelete')}}" enctype="multipart/form-data" method="post">--}}
                {{--{{csrf_field()}}--}}
                {{--<input type="hidden" value="{{$category->category_id}}" name="category_id">--}}

                {{--<input type="submit" class="btn-delete" value="{{trans('admin.delete_btn')}}">--}}
            {{--</form>--}}

            <button type="button" name="delete" class="icon-delete" value="{{$category->category_id}}">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                </span>
            </button>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="5">{{$categories->render()}}</td>
</tr>
