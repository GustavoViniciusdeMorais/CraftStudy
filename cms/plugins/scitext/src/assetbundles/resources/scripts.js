$( document ).ready(function() {

    // Read selection of sections to list entries
    $('#select-sectsion-handler').on('change', function(e){
        let selectedOption = $("option:selected", this);
        
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
        let selectedOption = $("option:selected", this);
        
        $.post({
            type: "POST",
            url: "scitext/get-entry-fields",
            data: {
                entryId: selectedOption.val()
            },
            success: function(result){
                $('#entry-fields').html(result.htmlFields);
                $('#entry-fields-overwrite').html(result.htmlFields);
                $('#entry-fields').removeAttr('hidden');
            }
        });
    });

    // Get entry field text
    $('#entry-fields').on('change', function(e){
        let selectedOption = $("option:selected", this);
        let entryId = $('#section-entries option:selected').val();
        
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

    // Show text summary result field
    $('#process-text').on('click', function(e){
        $('#output-div').removeAttr('hidden');
        $('#entry-fields-overwrite').removeAttr('hidden');
        $('#choose-field-save-summary').removeAttr('hidden');
    });

    // Save summary
    $('#save-sammary').on('click', function(e){
        if (confirm('Are you sure you want to overwrite the entry field content?')) {
            let entryId = $('#section-entries option:selected').val();
            let fieldHandle = $('#entry-fields-overwrite option:selected').val();
            let newValue = $('#output-div').text();

            $.post({
                type: "POST",
                url: "scitext/overwrite-entry-field",
                data: {
                    entryId: entryId,
                    fieldHandle: fieldHandle,
                    newValue: newValue
                },
                success: function(result){
                    if (result.hasOwnProperty('data')) {
                        $('#result-message').html(result.data);
                        console.log(result.data);
                    }
                }
            });
        } else {
            alert('Operation canceled with success!');
        }
    });

});