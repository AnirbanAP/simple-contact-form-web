jQuery(document).ready(function(err, data) {
    
    jQuery('#add-element-btn').click(function(){
		console.log('ss');
		
		var elements = jQuery('.form-elements').find('option:selected ').val();
		var elements_text = jQuery('.form-elements').find('option:selected ').text();

        if(elements == 'select'){
            jQuery('#exampleModalToggle .modal-body').find('.select-dropdown').show();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').hide();
        }else{
            jQuery('#exampleModalToggle .modal-body').find('.select-dropdown').hide();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').show();
        }

        if(elements == 'file'){
            jQuery('#exampleModalToggle .modal-body').find('.file-data').show();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').hide();
        }else{
            jQuery('#exampleModalToggle .modal-body').find('.file-data').hide();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').show();
        }

        if(elements == 'checkbox'){
            jQuery('#exampleModalToggle .modal-body').find('.checkbox-data').show();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').hide();
        }else{
            jQuery('#exampleModalToggle .modal-body').find('.checkbox-data').hide();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').show();
        }

        if(elements == 'radio'){
            jQuery('#exampleModalToggle .modal-body').find('.checkbox-data').show();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').hide();
        }else{
            jQuery('#exampleModalToggle .modal-body').find('.checkbox-data').hide();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').show();
        }

		jQuery('#exampleModalToggle').modal('show');

		jQuery('#exampleModalToggle .modal-body').find('select').html(
			'<option value="'+elements+'">'+elements_text+'</option>'
		);

		
	});

    jQuery('.save_form_elenets').click(function(e){
        e.preventDefault();

        jQuery.ajax({
            url: frontend_ajax_object.ajaxurl,
            type: 'POST',
			dataType: 'html',
            data: {
                action: 'add_form_element',
                element_type: jQuery('#element_type option').val(),
                element_label: jQuery('#element_label').val(),
                placeholder: jQuery('#placeholder').val(),
                field_required: jQuery('#field_required').is(':checked') ? 1 : 0,
                _ajax_nonce: frontend_ajax_object.nonce,
            },
            beforeSend: function() {
                jQuery('.save_form_elenets').text('Please Wait...');
            },
            success: function(res) {
                console.log(res);
                
                $('#form-elements-container').append(res);

                jQuery('#exampleModalToggle').modal('hide');
                jQuery('.save_form_elenets').text('Insert Data');
            },
            error: function() {
                alert('An error occurred while adding the form element.');
            }
        });
    });
    


});