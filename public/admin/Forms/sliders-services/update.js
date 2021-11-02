$(document).ready(function() {
    var form = $('#update-sliders-services-form');


    var image = form.find('#image');


    form.submit(function(e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        ifFileFoundAppend('image', image[0], formData);

        formData.append('_method', 'PATCH');


        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiDashboardURL + 'sliders-services/'+ document.location.href.split('/')[5],
            responseType: 'json',
            data: formData
        })
            .then(function(response) {
                toastr['success'](response.data.success, 'Success!', {
                    closeButton: true,
                    tapToDismiss: false,
                });
                onFormSuccess(form, false);
            })
            .catch(function(error) {

                onFormErrors(form);
                if (error.response.status === 422) {

                    fileFieldError(image, error.response.data.errors.image);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});