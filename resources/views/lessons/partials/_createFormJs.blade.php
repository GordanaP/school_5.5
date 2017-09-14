<script>
    var max_fields = 3; //maximum fields allowed
    var wrapper = $(".input_fields_wrap"); //fields wrapper
    var add_button = $(".add_field_button"); // add button

    var x = 0; //initial fields count

    // Add input field
    $(add_button).click(function(e){
        e.preventDefault();

        if(x < max_fields){
            x++;
            $(wrapper).append('<div class="flex align-center"><input type="text" class="form-control" name="readings[]" placeholder="Readings"/><a href="#" class="remove_field" >Remove</a></div>');
        }
    });

    //Remove input field
    $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault();

        $(this).parent('div').remove();
        x--;
    })
</script>