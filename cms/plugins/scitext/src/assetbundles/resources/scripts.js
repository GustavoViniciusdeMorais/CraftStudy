$( document ).ready(function() {

    // Read selection of sections to list entries
    $('#select-sectsion-handler').on('change', function(e){
        var selectedOption = $("option:selected", this);
        
        $.post({
            type: "POST",
            url: "scitext/get-entries",
            data: {
                sessionHandler: selectedOption.val()
            },
            success: function(result){
                console.log(result);
            }
        });
    });

});