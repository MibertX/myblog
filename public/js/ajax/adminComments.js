function validClick(that)
{
    $(that).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');

    $.ajax({
        type: "GET",
        data: {
            'comment_id': that.value,
            'valid': that.checked
        },
        url: "/adminzone/comments/validtoogle",

        success: function () {
            $(that).parents('div .panel').toggleClass('panel-warning')
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
            'comment_id': that.value,
            'seen': that.checked,
        },
        url: '/adminzone/comments/seentoogle',
        success: function () {
            $(that).parents('div .panel').toggleClass('panel-info')
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
    $.ajax({
        type: "POST",
        url: "/adminzone/comments/delete",
        dataType: "html",
        data: {
            '_token': $('input[name="_token"]').val(),
            'comment_id': button.value
        },
        success: function (data) {
            $(button).parents("#comments-container div.row").remove();
            var page = ($("#comments-container .pagination .active span").html());

            if (($("#comments-container").children().length) < 2) {
                --page;
            }

            if (page > 0) {
                getData(page)
            }
            createPopupForAjax(data)
        },
        error: function () {
            alert('false');
        },

    })
}

function setEventHandlersForTable() {
    $('button.icon-delete').on('click', function () {
        deleteClick(this);
    })

    $('.comments-table input:checkbox[name="seen"]').on('click', function(){
        seenClick(this);
    })

    $('.comments-table input:checkbox[name="valid"]').on('click', function() {
        validClick(this);
    })
}

function getData(page) {
    $.ajax({
        url: "/adminzone/comments/all",
        type: "GET",
        data: {
            'page': page
        },
        success: function (data) {
            $('#comments-container').empty().append(data);
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
        var page = $(this).attr('href').split('page=')[1];
        getData(page);
    })
})
