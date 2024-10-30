jQuery(document).ready(function(){

	var cptl_post_id = jQuery('.cptl-post-id').data('cptl-post-id');
	jQuery('body.single').find('h1').wrap('<div class="changeable-text"></div>');
	jQuery('<input type="text" class="changeable-text-field" name="field" value="" data-post-id="'+cptl_post_id+'">').appendTo(jQuery('div.changeable-text'));
	jQuery('<i class="fa fa-close"></i>').appendTo(jQuery('div.changeable-text'));

	jQuery('div.changeable-text h1').on('dblclick', function(){
		var inputContent = jQuery(this).text();
		jQuery(this).parent().find('input.changeable-text-field').val(inputContent);
		jQuery(this).parent().find('input.changeable-text-field').addClass('active');
		jQuery(this).parent().find('i.fa.fa-close').addClass('active');
		jQuery(this).parent().find('input.changeable-text-field').focus();
		jQuery(this).parent().find('input.changeable-text-field').select();
		jQuery(this).hide();
	});
	jQuery('input.changeable-text-field').on('keypress', function(e){
		if( e.which == '13' ) {

			// Check if new title is empty
			var newContent = jQuery(this).val();
			if( newContent == '' ) return false;
			
			// Define the data sent with AJAX
			var data = {
				'action': 'cptl_update_title',
				'security': cptlajax.security,
				'post_id': cptl_post_id,
				'new_title': newContent
			};

			// Store the parent element in a variable so we can use that, instead of $(this)
			var parentElem = jQuery(this);
			jQuery.post(cptlajax.ajaxurl, data, function(response){

				// Get JSON response
				var obj = JSON.parse(response);

				if(obj.msg === 'success') {
					// Finally replace the title
					parentElem.parent().find('h1').text(newContent);
					parentElem.parent().find('h1').show();
					parentElem.removeClass("active");
					parentElem.parent().find('i.fa.fa-close').removeClass('active');
				}
				
			});
		}
	});
	jQuery('div.changeable-text i.fa.fa-close').on('click', function(){
		jQuery(this).parent().find('h1').show();
		jQuery(this).parent().find('input.changeable-text-field').removeClass("active");
		jQuery(this).parent().find('i.fa.fa-close').removeClass('active');
	});
});