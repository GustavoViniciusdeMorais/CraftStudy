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
                $('#section-entries').html(result.htmlEntries);
                $('#section-entries').removeAttr('hidden');
            }
        });
    });

    // Read selection of entries list
    $('#section-entries').on('change', function(e){
        var selectedOption = $("option:selected", this);
        
        $.post({
            type: "POST",
            url: "scitext/get-entry-fields",
            data: {
                entryId: selectedOption.val()
            },
            success: function(result){
                $('#entry-fields').html(result.htmlFields);
                $('#entry-fields').removeAttr('hidden');
            }
        });
    });

    // Get entry field text
    $('#entry-fields').on('change', function(e){
        var selectedOption = $("option:selected", this);
        var entryId = $('#section-entries option:selected').val();
        
        $.post({
            type: "POST",
            url: "scitext/get-entry-field-text",
            data: {
                entryId: entryId,
                fieldHandle: selectedOption.val()
            },
            success: function(result){
                if (result.hasOwnProperty('data')) {
                    $("#text-input").val(result.data)
                }
            }
        });
    });

});