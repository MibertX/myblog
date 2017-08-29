var ORDERED_COLUMN = 'categories.name';
var DIRECTION = 'asc';

function activeClick(that)
{
    $(that).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');

    $.ajax({
        type: "GET",
        data: {
            'category_id': that.value,
            'active': that.checked
        },
        url: "/adminzone/categories/activetoogle",

        success: function () {
            $(that).parents('tr').toggleClass('panel-warning')
        },
        error: function () {
            $(that).prop('checked', $(that).prop('checked') == false)
        },

        complete: function () {
            $('.fa-spin').remove();
            $(that).show();
        }
    })
}

function seenClick(that) {
    $(that).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>')

    $.ajax({
        type: "GET",
        data: {
            'category_id': that.value,
            'seen': that.checked,
        },
        url: '/adminzone/categories/seentoogle',
        success: function () {
            $(that).parents('tr').toggleClass('panel-info')
        },
        error: function () {
            $(that).prop('checked', $(that).prop('checked') == false)
        },
        complete: function () {
            $('.fa-spin').remove();
            $(that).show();
        }
    })
}

function deleteClick(button)
{
    var counter = $(".responsive-table tr").length;
    console.log(counter);
    $.ajax({
        type: "POST",
        url: "/adminzone/categories/delete",
        dataType: "html",
        data: {
            '_token': $('input[name="_token"]').val(),
            'category_id': button.value
        },
        success: function (data) {
            $(button).parents("tr").remove();
            var page = ($(".responsive-table .pagination .active span").html());
            getData(page);
            
            createPopupForAjax(data);
        }
    })
}

function setEventHandlersForTable() {
    $('button.icon-delete').on('click', function () {
        deleteClick(this);
    })

    $('.responsive-table input:checkbox[name="seen"]').on('click', function(){
        seenClick(this);
    })

    $('.responsive-table input:checkbox[name="active"]').on('click', function() {
        activeClick(this);
    })
}

function getData(page) {
    $.ajax({
        url: "/adminzone/categories",
        type: "GET",
        data: {
            'ordered_column': ORDERED_COLUMN,
            'direction': DIRECTION,
            'page': page
        },
        success: function (data) {
            $('.responsive-table').children('tbody').empty().append(data);
            setEventHandlersForTable();
            location.hash = page;
        }
    })
}

$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        }else{
            getData(page);
        }
    }
});


$(document).ready( function () {
    setEventHandlersForTable()

    $(document).on('click', '.pagination a', function (event) {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getData(page);
    })

    $('.order').on('click', function () {
        var icon = $(this).children('i');
        var icons = $('.order').children('i');

        if(icon.hasClass('fa-sort-desc')) {
            icons.removeClass('fa-sort-desc fa-sort-asc').addClass('fa-sort');
            icon.removeClass('fa-sort-desc').addClass('fa-sort-asc');
            DIRECTION = 'asc';
        } else {
            icons.removeClass('fa-sort-desc fa-sort-asc').addClass('fa-sort');
            icon.removeClass('fa-sort-asc').addClass('fa-sort-desc');
            DIRECTION = 'desc';
        }
        ORDERED_COLUMN = $(this).prop('name');

        $.ajax({
            type: "GET",
            url: "/adminzone/categories",
            data: {
                '_token': $('input[name="_token"]').val(),
                'direction': DIRECTION,
                'ordered_column': ORDERED_COLUMN
            },
            success: function (data) {
                $('.responsive-table').children('tbody').empty().append(data);
                setEventHandlersForTable();
            }
        })
    })

})
