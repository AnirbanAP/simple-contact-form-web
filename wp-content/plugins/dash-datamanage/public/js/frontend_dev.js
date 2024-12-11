
jQuery(document).ready(function(err, data) {

    jQuery(document).on('submit', '.dynamic-form-html form', function(e){
        e.preventDefault();
        var form = jQuery(this);
        console.log(form);
        var formData = new FormData(form[0]); 
        var postID = jQuery("input[name='post_id']").val();

        formData.append('action', 'frontend_form_submission');
        formData.append('post_id', postID);
        formData.append('nonce', frontend_ajax.nonce);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        
        jQuery.ajax({
            url: frontend_ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // form.find("button").prop("disabled", true).text("Submitting...");
                form.find("button").text("Submitting...");
            },
            success: function (res) {
                console.log(res);
                
                // if (response.success) {
                //     alert(response.data.message);
                //     form[0].reset();
                // } else {
                //     alert(response.data.message || "An error occurred.");
                // }
            },
            error: function () {
                alert("An error occurred while submitting the form.");
            },
            complete: function () {
                // form.find("button.contact_form").prop("disabled", false).text("Submit");
            },
        });
    })

});