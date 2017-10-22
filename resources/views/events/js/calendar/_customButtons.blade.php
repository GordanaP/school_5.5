newEvent: {
    text: 'New event',
    click: function(event, jsEvent, view)
    {
        var today = moment();

        // Open the modal
        $('#eventModal').modal('show');

        // Set the modal parameters
        $(".modal-title i").addClass("fa-pencil");
        $(".modal-title span").text("New event");
        $(".cancel-button").text("Cancel");
        $(".event-button").text("Create event").attr('id', 'storeEvent');

        $("#eventDate").val(today.format(eventDate));
        $("#start").val('8:00');
        $("#end").val('8:45');
    }
},