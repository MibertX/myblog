var DIRECTION = 'asc';
var ORDERED_COLUMN = 'users.name';

function setEventHandlersForTable() {
    $('.icon-delete').on('click', function () {
        deleteClick(this);
    })

    $('input:checkbox[name="seen"]').on('click', function () {
        seenClick(this);
    })

    $('.icon-action').on('click', function () {
        openUserWindowClick(this);
    })

    $('.icon-ban').on('click', function () {
        banClick(this);
    })
}

function deleteClick(that) {
    $.ajax({
        type: "POST",
        url: "/adminzone/users/delete",
        data: {
            '_token': $('input[name="_token"]').val(),
            'user_id': that.value
        },
        success: function (data) {
            $(that).parents("tr").remove();
            createPopupForAjax(data);
            var page = ($(".responsive-table .pagination .active span").html());
            getData(page)
        }
    })
}

function seenClick(that) {
    $(that).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>')

    $.ajax({
        type: "GET",
        data: {
            'user_id': that.value,
            'seen': that.checked,
        },
        url: '/adminzone/users/toogleseen',
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

function banClick(that) {
    var icon = $(that).find('span i:nth-child(2)');
    var ban = icon.hasClass('fa-ban');
    $.ajax({
        type: "GET",
        data: {
            "ban": ban,
            "user_id": that.value,
        },
        url: "/adminzone/users/toogleban",
        success: function () {
            if (icon.hasClass('fa-ban')) {
                icon.removeClass('fa-ban').addClass('fa-unlock');
            } else {
                icon.removeClass('fa-unlock').addClass('fa-ban')
            }
            $(that).toggleClass('icon-unlock')
            $(that).parents('tr').toggleClass('panel-warning')
        },
    })
}

function getData(page) {
    $.ajax({
        url: "/adminzone/users/all",
        type: "GET",
        data: {
            'direction': DIRECTION,
            'ordered_column': ORDERED_COLUMN,
            'page': page
        },
        success: function (data) {
            $('.responsive-table').children('tbody').empty().append(data);
            setEventHandlersForTable();
            location.hash = page;
        }
    })
}


$(document).ready( function () {
    setEventHandlersForTable();

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
            url: "/adminzone/users/all",
            data: {
                '_token': $('input[name="_token"]').val(),
                'direction': DIRECTION,
                'ordered_column': ORDERED_COLUMN
            },
            success: function (data) {
                $('.responsive-table').children('tbody').empty().append(data);
                setEventHandlersForTable();
            },
        })
    })
})
