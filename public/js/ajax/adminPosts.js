/**
 * Created by Mibert on 20.07.2017.
 */
var ORDERED_COLUMN = 'created_at';
var DIRECTION = 'desc';

function seenClick(that) {
    $(that).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');

    $.ajax({
        type: "GET",
        data: {
            'post_id': that.value,
            'seen': that.checked
        },
        url: "/adminzone/posts/seentoogle",
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


function activeClick(that) {
    $(that).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
    $.ajax({
        type: "GET",
        data: {
            'post_id': that.value,
            'active': that.checked
        },
        url: "/adminzone/posts/activetoogle",
        success: function () {

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


function deleteClick(that) {
    $.ajax({
        type: "POST",
        dataType: "html",
        data: {
            '_token': $('input[name="_token"]').val(),
            'post_id': that.value
        },
        url: "/adminzone/posts/delete",
        success: function (data) {
            $(that).parents("tr").remove();
            // $('#notification').empty().append(data).show();
            createPopupForAjax(data);
            console.log(data);
        }
    })
}


function setEventHandlersForTable() {
    $('.responsive-table input:checkbox[name="seen"]').on('change' , function () {
        seenClick(this)
    })

    $('.responsive-table input:checkbox[name="active"]').on('change', function () {
        activeClick(this)
    })

    $('.responsive-table .icon-delete').on('click', function () {
        deleteClick(this);
    })
}


function getData(page) {
    $.ajax({
        url: '/adminzone/posts/all',
        type: "GET",
        data: {
            'direction': DIRECTION,
            'ordered': ORDERED_COLUMN,
            'page': page
        },
        success: function (data) {
            $('.responsive-table').children('tbody').empty().append(data);
            setEventHandlersForTable();
            location.hash = page;
        },
        error: function () {
            alert('false')
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

    $(document).on('click', '.pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
        var myurl = $(this).attr('href');
        var page=$(this).attr('href').split('page=')[1];
        getData(page, myurl);
    })

    $('.order').on('click', function () {
        var icon = $(this).children('i');
        var icons = $('.order').children('i');
        console.log();
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
            url: "/adminzone/posts/all",
            data: {
                '_token': $('input[name="_token"]').val(),
                'direction': DIRECTION,
                'ordered': $(this).prop('name')
            },
            success: function (data) {
                $('.responsive-table').children('tbody').empty().append(data);
                setEventHandlersForTable();
            },
            error: function () {
                alert('Flase')
            }
        })
    })
})