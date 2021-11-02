$( "#contact-us" ).validate({

    rules: {
        name: {
            required: true
        },
        email: {
            required: true
        },
        message: {
            required: true
        },


    },
    submitHandler:function () {
        var form=$(this);

        var name =$('#name');
        var email =$('#email');
        var message =$('#message');

        var formData = new FormData();

        formData.append('name',name.val());
        formData.append('email',email.val());
        formData.append('message',message.val());

        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiWebsiteURL + 'send-contact-us',
            responseType: 'json',
            data: formData
        })
            .then(function(response) {
                // toastr['success'](response.data.success, 'Success!', {
                //     closeButton: true,
                //     tapToDismiss: false,
                // });

                Swal.fire({
                    type: 'success',
                    title: response.data.success,
                    showConfirmButton: false,
                    timer: 1500

                });
                email.val('');
                name.val('');
                message.val('');
            })
            .catch(function(error) {
                onFormErrors(form);
                if (error.response.status === 422) {

                    textFieldError(name, error.response.data.errors.name);
                    textFieldError(email, error.response.data.errors.email);
                    textFieldError(message, error.response.data.errors.message);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });

    }
});