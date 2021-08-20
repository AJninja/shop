jQuery(document).ready(function($){

	
	if ( $('.apus-image-settings .upload_image').val() ) {
		var attachment_url = $('.apus-image-settings .upload_image').val();
		$('.apus-image-settings .screenshot').empty().hide().prepend('<img src="' + attachment_url + '">').slideDown('fast');
	}
});