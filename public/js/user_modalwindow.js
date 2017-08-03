function closeUserWindowClick() {
    $(document).on('click', '#close-user', function () {
        $('body #transparent').remove();
    })
}

$(document).ready(function () {
    $('.icon-action').on('click', function () {
        $.ajax({
            type: "GET",
            url: "/users/one",
            data: {
                'user_id': this.value
            },
            success: function (data) {
                $('body').append(data);
                closeUserWindowClick();
            }
        })
    })
})
