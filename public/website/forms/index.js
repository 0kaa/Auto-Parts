$( "#newsletter" ).validate({

    rules: {
        email: {
            required: true
        }


    },
    submitHandler:function () {
        var form=$(this);

        var email =$('#email');

        var formData = new FormData();

        formData.append('email',email.val());

        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiWebsiteURL + 'subscribe',
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
                onFormSuccess(form, false);
            })
            .catch(function(error) {
                onFormErrors(form);
                if (error.response.status === 422) {

                    textFieldError(email, error.response.data.errors.email);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });

    }
});