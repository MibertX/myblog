function closeUserWindowClick() {
    $(document).on('click', '#close-user', function () {
        $('body #transparent').remove();
    })
}

function openUserWindowClick(that) {
    $.ajax({
        type: "GET",
        url: "/users/one",
        data: {
            'user_id': that.value
        },
        success: function (data) {
            $('body').append(data);
            closeUserWindowClick();
        }
    })
}

$(document).ready(function () {
    $('.user-window').on('click', function () {
        openUserWindowClick(this);
    })
})
