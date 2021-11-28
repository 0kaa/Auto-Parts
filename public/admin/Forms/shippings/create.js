$(document).ready(function () {
    var form = $('#create-shippings-form');
    var shipping_name_en = form.find('#shipping_name_en');
    var shipping_name_ar = form.find('#shipping_name_ar');


    form.submit(function (e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        formData.append('shipping_name_en', shipping_name_en.val());
        formData.append('shipping_name_ar', shipping_name_ar.val());



        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiDashboardURL + 'shippings',
            responseType: 'json',
            data: formData
        })
            .then(function (response) {
                toastr['success'](response.data.success, 'Success!', {
                    closeButton: true,
                    tapToDismiss: false,
                });
                onFormSuccess(form, true);
            })
            .catch(function (error) {
                console.log(error)
                onFormErrors(form);
                if (error.response.status === 422) {
                    textFieldError(shipping_name_en, error.response.data.errors.shipping_name_en);
                    textFieldError(shipping_name_ar, error.response.data.errors.shipping_name_ar);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});