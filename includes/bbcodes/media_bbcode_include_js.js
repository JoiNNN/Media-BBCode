$('#insert_media').click(function() {
    var media_input = $('#media_input').val();
    insertText('message', '[media]' + media_input + '[/media]','input_form');
    // Empty media input after insert
    $('#media_input').val('');
});