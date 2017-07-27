/**
 * Created by Mibert on 22.07.2017.
 */

function createPopupForAjax(data) {
    $('#notification').empty().append(data);
    showPopup();
}

function showPopup()
{
    var height = $('#notification').css('height')
    $('#notification').css('bottom', '-'+height).show();

    $('#notification').animate({
        bottom: '2%'
    }, 500);

    $('#notification').on('click', '#close-popup', function () {
        $('#notification').empty().hide();
    })
}

$(document).ready(function () {
    if ($('#notification').not(':empty')) {
        showPopup();
    }
})