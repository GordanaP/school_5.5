var start = moment(event.start);
var end = moment(event.end);

//Add class to multiple days event - class attribute in CSS
while( start.format(eventDate) != end.format(eventDate) ){
    var dataToFind = start.format(eventDate);
    $("td[data-date='"+dataToFind+"']").addClass('activeDay');
    start.add(1, 'd');
}