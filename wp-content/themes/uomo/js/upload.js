jQuery(document).ready(function($){
	"use strict";
	var uomo_upload;
	var uomo_selector;

	function uomo_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		uomo_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( uomo_upload ) {
			uomo_upload.open();
			return;
		} else {
			// Create the media frame.
			uomo_upload = wp.media.frames.uomo_upload =  wp.media({
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
			uomo_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = uomo_upload.state().get('selection').first();

				uomo_upload.close();
				uomo_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					uomo_selector.find('.uomo_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		uomo_upload.open();
	}

	function uomo_remove_file(selector) {
		selector.find('.uomo_screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.uomo_upload_image_action .remove-image', function(event) {
		uomo_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.uomo_upload_image_action .add-image', function(event) {
		uomo_add_file(event, $(this).parent().parent());
	});

});