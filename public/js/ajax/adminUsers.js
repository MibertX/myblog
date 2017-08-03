function createTransparentBackground() {
    var div = "<div id='transparent'></div>"
    $('body').append(div)
        .css({
            position: 'absolute',
            width: '100%',
            height: '100%',
            backgroundColor: 'black',
            opacity: '0.5',
            pointerEvents: 'none'
        })
    
    return $('body #transparent');
}



$(document).ready( function () {
    $('.icon-ban').on('click', function () {
        var icon = $(this).find('span i:nth-child(2)');

        if (icon.hasClass('fa-ban')) {
            var ban = true;
            icon.removeClass('fa-ban').addClass('fa-unlock');
        } else {
            var ban = false;
            icon.removeClass('fa-unlock').addClass('fa-ban')
        }

        $.ajax({
            type: "GET",
            data: {
                "ban": ban,
                "user_id": this.value
            },
            url: "/adminzone/users/toogleban",
            complete: function (data) {
                // console.log(data);
            }
        })
    })

    
})
