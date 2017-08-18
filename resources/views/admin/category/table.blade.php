@foreach($categories as $category)
    <tr {{!$category->seen ? 'class=panel-warning' : ''}} >
        <td class="table-row-name">{{trans('categories.' . $category->name)}}</td>
        <td class="text-center">{{$category->posts}}</td>

        @can('toogleCategorySeen', Auth::user())
        <td class="align-center">
            <input type="checkbox" name="seen" value="{{$category->category_id}}" {{$category->seen == 1 ? 'checked' : ''}}>
        </td>
        @endcan

        @can('toogleCategoryActive', Auth::user())
        <td class="align-center">
            <input type="checkbox" name="active" value="{{$category->category_id}}" {{$category->active == 1 ? 'checked' : ''}}>
        </td>
        @endcan

        <td class="td-for-btn">
            <a href="{{route('getByCategories', ['category' => $category->name])}}" class="icon-extra">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>

        <td class="td-for-btn">
            @can('updateCategory', Auth::user())
            <a href="{{route('categoryUpdateView', array('id' => $category->category_id))}}" class="icon-edit">
            @else
            <a href="#" class="icon-disabled">
            @endcan
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>
        <td class="td-for-btn">
            @can('deleteCategory', Auth::user())
                <?php $icon_class = 'icon-delete' ?>
            @else
                <?php $icon_class = 'icon-disabled' ?>
            @endcan
            <button type="button" name="delete" class="{{$icon_class}}" value="{{$category->category_id}}">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                </span>
            </button>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="7">{{$categories->render()}}</td>
</tr>
