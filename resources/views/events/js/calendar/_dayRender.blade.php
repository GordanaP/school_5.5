$('#datepicker').datepicker()
    .on("change", function (e)
    {
        changeCellColor(date, cell, e)
    });