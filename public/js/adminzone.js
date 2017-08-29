var MENU_IS_OPEN = false;

function minimizeMenu() {
    $('#admin-nav #button-menu i').toggleClass('fa-arrow-circle-o-left');
    $('.admin-main-menu ul ul').removeClass('in');

    $('.content-wrapper').animate({
        paddingLeft: '50px'
    }, 150)

    $('.admin-main-menu').animate({
        width: '50px'
    }, 150)

    $('#admin-nav span.item-name').animate({
        maxWidth: '0',
    }, 150)

    MENU_IS_OPEN = false;
}

function maximizeMenu() {
    $('#admin-nav #button-menu i').toggleClass('fa-arrow-circle-o-left');

    if (!widthLessThenBootstrapMD()) {
        $('.content-wrapper').animate({
            paddingLeft: '200px'
        }, 150)
    }

    $('.admin-main-menu').animate({
        width: '200px'
    }, 150)

    $('#admin-nav span.item-name').animate({
        maxWidth: '125px',
    }, 150)

    MENU_IS_OPEN = true;
}

function widthLessThenBootstrapMD() {
    return $('#bootstrap-width-for-js').css('display') == 'none'
}

$(document).ready(function () {
    $(window).on('resize', function () {
        if (widthLessThenBootstrapMD() && MENU_IS_OPEN) {
            minimizeMenu()
        }
    })

    $('#admin-nav a[data-toggle="collapse"]').on('click', function () {
        if (!MENU_IS_OPEN) {
            maximizeMenu()
        }
    })

    $('#button-menu').on('click', function () {
        if (MENU_IS_OPEN) {
            minimizeMenu();
        } else {
            maximizeMenu()
        }
    })
})
