$(document).ready(function () {
    $('#data tbody tr:even').css('background-color', 'silver');
});

$(document).ready(function () {
    $('#data tbody tr:odd').css('background-color', 'lightblue');
});

$(document).ready(function () {
    $('#data tbody tr').hover(function () {
        $(this).addClass('highlight');
    }, function () {
        $(this).removeClass('highlight');
    });
});

