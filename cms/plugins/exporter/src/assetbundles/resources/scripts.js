$( document ).ready(function() {
    $('#select-session-handler').on('change', function(e){
        var selectedOption = $("option:selected", this);
        
        $.post({
            type: "POST",
            url: "vikiport/get-entries",
            data: {
                sessionHandler: selectedOption.val()
            },
            success: function(result){
                console.log(result);
            }
        });
    });
});
