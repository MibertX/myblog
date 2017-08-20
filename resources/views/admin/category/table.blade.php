@can('toogleCategorySeen', Auth::user())
    <?php $can_toogle_seen = true ?>
@endcan

@can('toogleCategoryActive', Auth::user())
    <?php $can_toogle_active = true ?>
@endcan

@cannot('updateCategory', Auth::user())
    <?php $button_update_disable = true ?>
@endcannot

@cannot('deleteCategory', Auth::user())
    <?php $button_delete_disable = true ?>
@endcannot

@foreach($categories as $category)
    <tr class="{{!$category->seen ? 'panel-info' : ''}} {{!$category->active ? 'panel-warning' : ''}}">
        <td class="table-row-name">{{trans('categories.' . $category->name)}}</td>
        <td class="text-center">{{$category->posts}}</td>

        @if (isset($can_toogle_seen))
        <td class="align-center">
            <input type="checkbox" name="seen" value="{{$category->category_id}}" {{$category->seen == 1 ? 'checked' : ''}}>
        </td>
        @endif

        @if (isset($can_toogle_active))
        <td class="align-center">
            <input type="checkbox" name="active" value="{{$category->category_id}}" {{$category->active == 1 ? 'checked' : ''}}>
        </td>
        @endif

        <td class="td-for-btn">
            <a href="{{route('getByCategories', ['category' => $category->name])}}" class="icon-extra">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>

        <td class="td-for-btn">
            <a href="{{route('categoryUpdateView', array('id' => $category->category_id))}}"
               class="icon-edit {{isset($button_update_disable) ? 'icon-disabled' : ''}}">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </td>
        <td class="td-for-btn">
            <button type="button" name="delete" value="{{$category->category_id}}"
                    class="icon-delete {{isset($button_delete_disable) ? 'icon-disabled' : ''}}" >
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
