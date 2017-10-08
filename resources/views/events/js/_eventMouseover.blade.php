// Tooltip showing on hovering over the event
var tooltip = '<div class="event__tooltip">Time: ' + event.start.format(eventTime) + ' - ' + event.end.format(eventTime) + '</div>';

$("body").append(tooltip);

$(this).mouseover(function (e) {
    $(this).css('z-index', 10000);
    $('.event__tooltip').fadeIn('500');
    $('.event__tooltip').fadeTo('10', 1.9);
})
.mousemove(function (e)
{
    $('.event__tooltip').css('top', e.pageY + 10);
    $('.event__tooltip').css('left', e.pageX + 20);
});


