jQuery(document).ready(function($){
	"use strict";
    var section_index = 2;
    section_index = $('.sizeguides-manager-options .sizeguides-section-wrapper .sizeguides-section').length;
    // section
    $('.sizeguides-manager-options').on('click', '.addsection', function(){
        var section_html = $(this).data('section');
        section_index = section_index + 1;
        section_html = section_html.replace('{{d}}', section_index);
        $(this).closest('.sizeguides-manager-options').find('.sizeguides-section-wrapper').append(section_html);
    });

    $('.sizeguides-manager-options').on('click', '.delsection', function(){
        $(this).closest('.sizeguides-section').remove();
    });

    // col
    $('.sizeguides-manager-options').on('click', '.addcol', function(){
        var table_container = $(this).closest('.sizeguides-table-edit');
        var index = $(this).closest('th').index();
        table_container.find('thead tr th').eq(index).after('<th><a class="addcol icon-button" href="javascript:void(0);">+</a> <a class="delcol icon-button" href="javascript:void(0);">-</a></th>');
        table_container.find('tbody tr').each(function(){
            $(this).find('td').eq(index).after('<td><input type="text" value=""></td>');
        });

        sizeguides_update(table_container);
    });

    $('.sizeguides-manager-options').on('click', '.delcol', function(){
        var table_container = $(this).closest('.sizeguides-table-edit');
        var index = $(this).closest('th').index();
        table_container.find('thead tr th').eq(index).remove();
        table_container.find('tbody tr').each(function(){
            $(this).find('td').eq(index).remove();
        });

        sizeguides_update(table_container);
    });

    // row
    $('.sizeguides-manager-options').on('click', '.addrow', function(){
        var table_container = $(this).closest('.sizeguides-table-edit');
        var td_length = $(this).closest('tr').find('td').length;

        var html = '<tr>';
        for (var i = 0; i < (td_length - 1 ); i++) {
            html += '<td><input type="text" value=""></td>';
        }
        html += '<td><a class="addrow icon-button" href="javascript:void(0);">+</a> <a class="delrow icon-button" href="javascript:void(0);">-</a></td>';
        html += '</tr>';

        $(this).closest('tr').after(html);

        sizeguides_update(table_container);
    });

    $('.sizeguides-manager-options').on('click', '.delrow', function(){
        var table_container = $(this).closest('.sizeguides-table-edit');
        $(this).closest('tr').remove();

        sizeguides_update(table_container);
    });
    
    $('.sizeguides-manager-options').on( 'input', 'input', function() {
        var table_container = $(this).closest('.sizeguides-table-edit');
        sizeguides_update(table_container);
    } );
    
    function sizeguides_export_data(table_container) {
        var row = 0,
            data = [],
            value;

        table_container.find('tbody tr').each(function () {

            row += 1;
            data[row] = [];

            $(this).find('td:not(:last-child)').each(function (i, v) {
                
                value = $(this).find('input[type="text"]').val();
                
                data[row].push(value);

            });

        });

        // Remove undefined
        data.splice(0, 1);

        return data;
    }

    function sizeguides_update(table_container) {
        var section_container = table_container.closest('.sizeguides-section');
        section_container.find('textarea.sizeguides-table-data').val( JSON.stringify(sizeguides_export_data(table_container)) );
    }



    // upload image
    var sizeguides_upload;
    var sizeguides_selector;

    function sizeguides_add_file(event, selector) {

        var upload = $(".uploaded-file"), frame;
        var $el = $(this);
        sizeguides_selector = selector;

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if ( sizeguides_upload ) {
            sizeguides_upload.open();
            return;
        } else {
            // Create the media frame.
            sizeguides_upload = wp.media.frames.sizeguides_upload =  wp.media({
                // Set the title of the modal.
                title: "Select Image",

                // Customize the submit button.
                button: {
                    // Set the text of the button.
                    text: "Selected",
                    // Tell the button not to close the modal, since we're
                    // going to refresh the page when the image is selected.
                    close: false
                }
            });

            // When an image is selected, run a callback.
            sizeguides_upload.on( 'select', function() {
                // Grab the selected attachment.
                var attachment = sizeguides_upload.state().get('selection').first();

                sizeguides_upload.close();
                sizeguides_selector.find('.upload_image').val(attachment.attributes.id).change();
                if ( attachment.attributes.type == 'image' ) {
                    sizeguides_selector.find('.sizeguides_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
                }
            });

        }
        // Finally, open the modal.
        sizeguides_upload.open();
    }

    function sizeguides_remove_file(selector) {
        selector.find('.sizeguides_screenshot').slideUp('fast').next().val('').trigger('change');
    }
    
    $('body').on('click', '.sizeguides_upload_image_action .remove-image', function(event) {
        sizeguides_remove_file( $(this).parent().parent() );
    });

    $('body').on('click', '.sizeguides_upload_image_action .add-image', function(event) {
        sizeguides_add_file(event, $(this).parent().parent());
    });
});