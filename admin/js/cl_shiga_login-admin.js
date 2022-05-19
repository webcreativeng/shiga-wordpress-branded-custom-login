jQuery( document ).ready(
	function($){
		$( '#cl_upload_image_btn' ).click(
			function (e) {
				let custom_uploader;
				custom_uploader = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Featured Image',
						button: {
							text: 'Select this Image'
						},
						multiple: false
					}
				);
				custom_uploader.on(
					'select',
					function () {
						let attachment;
						attachment = custom_uploader.state().get( 'selection' ).first().toJSON();
						jQuery( 'input#cl_login_logo_id' ).val( attachment.id );
						$.ajax(
							{
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'cl_ajax_get_image',
									img: attachment.id
								},
								success: function (data) {
									$( '#cl_upload_image_preview' ).html( data );
								},
								error: function (MLHttpRequest, textStatus, errorThrown) {
									alert( errorThrown );
								}
							}
						);
					}
				);
				custom_uploader.open();
			}
		);

		// Submit Options Settings Page
		$( '#cl_update_options_submit' ).click(
			function (e) {
				e.preventDefault();
				let imgId   = jQuery( 'input#cl_login_logo_id' ).val();
				let colorId = jQuery( 'input#cl_login_color_id' ).val();
				let nonce   = jQuery( 'input#cl_upd_nonce' ).val();
				// alert( colorId );
				$.ajax(
					{
						type: 'POST',
						url: ajaxurl,
						data: {
							action: 'cl_update_options',
							nonce: nonce,
							colorId: colorId,
							imgId: imgId
						},
						success: function (data) {
							// return data;
							alert( 'Settings updated successfully' );
							location.reload();

						},
						error: function (MLHttpRequest, textStatus, errorThrown) {
							console.log( errorThrown );
						}
					}
				);
			}
		);

		$( '.cl_color_field' ).wpColorPicker();
	}
);
