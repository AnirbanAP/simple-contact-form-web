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
            jQuery('#exampleModalToggle .modal-body').find('.radio-data').show();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').hide();
        }else{
            jQuery('#exampleModalToggle .modal-body').find('.radio-data').hide();
            jQuery('#exampleModalToggle .modal-body').find('.placeholder-ele').show();
        }

		jQuery('#exampleModalToggle').modal('show');

		jQuery('#exampleModalToggle .modal-body').find('select').html(
			'<option value="'+elements+'">'+elements_text+'</option>'
		);
        jQuery('#exampleModalToggle .modal-body').find('#element_name').val(elements + '-' + Math.floor(Math.random() * 300));
	});

    // ------------------ Check form type -------------- //

    var selectformType = jQuery('input[name="inlineRadioOptions"]').val();
    jQuery('#s_c_form_type').val(selectformType);

     jQuery('input[name="inlineRadioOptions"]').change(function(){
        var selectedValue = jQuery(this).val();
        jQuery('#s_c_form_type').val(selectedValue);
     })

    // ---------- editor --------------------

    var html_editor = new FroalaEditor('#froala-editor');

    jQuery('.save_form_elenets').click(function(e){
        e.preventDefault();

        jQuery.ajax({
            url: frontend_ajax_object.ajaxurl,
            type: 'POST',
			dataType: 'html',
            data: {
                action        : 'add_form_element',
                element_type  : jQuery('#element_type option').val(),
                element_label : jQuery('#element_label').val(),
                placeholder   : jQuery('#placeholder').val(),
                field_required: jQuery('#field_required').is(':checked') ? 1 : 0,
                dropdown_field: jQuery('#dropdown_field').val(),
                checkbox_field: jQuery('#checkbox_field').val(),
                radio_field   : jQuery('#radio_field').val(),
                fileinput     : jQuery('#fileinput').val(),
                filesize      : jQuery('#filesize').val(),
                extra_class   : jQuery('#extra_class').val(),
                element_name  : jQuery('#element_name').val(),
                _ajax_nonce   : frontend_ajax_object.nonce,
            },
            beforeSend: function() {
                jQuery('.save_form_elenets').text('Please Wait...');
            },
            success: function(res) {
                console.log(res);
                
                jQuery('#form-elements-container').append(res);

                jQuery('#exampleModalToggle').modal('hide');
                jQuery('.save_form_elenets').text('Insert Data');
            },
            error: function() {
                alert('An error occurred while adding the form element.');
            }
        });
    });


    // ----------------- Form save js -------------- //

    jQuery('.submitnewform').click(function(e){
        e.preventDefault();

        var htmlcontext = html_editor.html.get();
        var htmldata    = jQuery(htmlcontext).text();

        jQuery.ajax({
            url: frontend_ajax_object.ajaxurl,
            type: 'POST',
			dataType: 'json',
            data: {
                action: 'add_form_data_to_post',
                form_name: jQuery('#form_name').val(),
                form_element: jQuery('#form-elements-container').html(),
                form_type  :  jQuery('#s_c_form_type').val(),
                froala_editor: htmldata,
                _ajax_nonce: frontend_ajax_object.nonce,
            },
            beforeSend: function() {
                jQuery('.submitnewform').text('Please Wait...');
            },
            success: function(res) {
                console.log(res);
                if(res.success){
                    Swal.fire({
                        title: "Form Saved Successfully!",
                        icon: "success",
                        confirmButtonText: "Close"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = frontend_ajax_object.admin_url + 'admin.php?page=dynamic_contact_form';
                        }
                    });
                }
            },
            error: function() {
                alert('An error occurred while adding the form element.');
            }
        });

    });

    jQuery('.c_s_deleteform').click(function() {

        var postid = jQuery(this).attr('data-postid');
        jQuery.ajax({
            url: frontend_ajax_object.ajaxurl,
            type: 'POST',
			dataType: 'json',
            data: {
                action: 'delete_form',
                postid: postid,
                _ajax_nonce: frontend_ajax_object.delete_nonce,
            },
            beforeSend: function() {
                // jQuery('.submitnewform').text('Please Wait...');
            },
            success: function(res) {
                console.log(res);
               
                if(res.success) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                      }).then((result) => {
                        if (result.isConfirmed) {
                           jQuery('#form-listing-table tr[data-formpostid='+postid+']').remove();
                          Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                          }).then((result) => {
                                 jQuery('#form-listing-table').data.reload();
                          })
                        }
                      });
                    
                    
                }else{
                    alert('An error occurred while deleting the form.');
                }
               
            },
            error: function() {
                alert('An error occurred while adding the form element.');
            }
        });
    });
    


});