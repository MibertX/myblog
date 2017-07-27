$(document).ready( function () {
    $('#button_ajax').on('click', function () {

        $.ajax({
            url: "http://myblog/adminzone/posts/ajax",
            type: "GET",
            dataType: 'text',
            data: {
                key: 'value'
            },

            // contentType: 'multipart/form-data',
            success: function (msg) {
                $('#button_ajax').html('pizdec')

            },
            error: function (data) {
                // alert('false')
            }
        })
    })
})
