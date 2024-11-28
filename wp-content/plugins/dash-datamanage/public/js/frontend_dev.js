
jQuery(document).ready(function(err, data) {

    jQuery(document).on('submit', '.dynamic-form-html form', function(e){
        e.preventDefault();
        var form = jQuery(this);
        var postID = form.find("input[name='post_id']").val();
        var formData = {};

        form.find("input, textarea, select").each(function (e, type) {
            
            const name = jQuery(this).attr("name");
            const value = jQuery(this).val();
            if (name) {
                formData[name] = value;
            }
        });
        


        jQuery.ajax({
            url: frontend_ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'frontend_form_submission_function',
                post_id: postID,
                form_data: formData,
                nonce:     frontend_ajax.nonce
            },
            beforeSend: function () {
                form.find("button").prop("disabled", true).text("Submitting...");
            },
            success: function (response) {
                if (response.success) {
                    alert(response.data.message);
                    form[0].reset();
                } else {
                    alert(response.data.message || "An error occurred.");
                }
            },
            error: function () {
                alert("An error occurred while submitting the form.");
            },
            complete: function () {
                form.find("button.contact_form").prop("disabled", false).text("Submit");
            },
        });
    })

});