var ORDERED_COLUMN = 'categories.name';
var DIRECTION = 'asc';

function deleteClick(button)
{
    $.ajax({
        type: "POST",
        url: "/adminzone/categories/delete",
        dataType: "html",
        data: {
            '_token': $('input[name="_token"]').val(),
            'category_id': button.value
        },
        success: function () {
            $(button).parents("tr").remove();
            if ($(".responsive-table").children("tr").length < 1) {
                var previous_page = ($(".responsive-table .pagination .active span").html()) -1;

                if (previous_page > 0) {
                    getData(previous_page)
                }
            }
        },
        error: function () {
            alert('false');
        }
    })
}

function setEventHandlersForTable() {
    $('button.icon-delete').on('click', function () {
        deleteClick(this);
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

    $(document).on('click', '.pagination a', function (event) {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        console.log(this);
        event.preventDefault();
        var myurl = $(this).attr('href');
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
            },
            error: function () {
                alert('Flase')
            }
        })
    })

})
