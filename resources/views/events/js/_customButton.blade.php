newEvent: {
    text: 'New event',
    click: function(event, jsEvent, view){

        // Open the modal
        $('#eventModal').modal('show');

        // Set the modal parameters
        $('.modal-title span').text('New event'); // Add title
        $('.modal-title i').addClass('fa-pencil'); // Add class to the title icon
        $('.modal .event__button').text('Create event').attr('id', 'storeEvent'); // Add text & attr to the event button
        $('.modal .cancel__button').text('Cancel'); // Add text to the cancel button

        // Set the time values
        $('#start').val('08:00');
        $('#end').val('08:45');
    },
}