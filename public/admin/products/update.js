$(document).ready(function () {
    var form = $('#update-products-form');

    var id = $('#id').val();

    var name = form.find('#name');
    var description = form.find('#description');
    var image = form.find('#image');
    var price = form.find('#price');
    var seller_id = form.find('#seller_id');

    form.submit(function (e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        formData.append('name', name.val());
        formData.append('description', description.val());
        ifFileFoundAppend('image', image[0], formData);
        formData.append('price', price.val());
        formData.append('seller_id', seller_id.val());

        var allFeatures = [];
        $(".array_features").each(function () {
            allFeatures.push($(this).val());
        });

        var allDetails = [];
        $(".array_details").each(function () {
            allDetails.push($(this).val());
        });

        formData.append('featuresarray', allFeatures);
        formData.append('detailsarray', allDetails);


        formData.append('_method', 'PATCH');


        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiDashboardURL + 'products/update/' + id,
            responseType: 'json',
            data: formData
        })
            .then(function (response) {
                toastr['success'](response.data.success, 'Success!', {
                    closeButton: true,
                    tapToDismiss: false,
                });
                onFormSuccess(form, false);
            })
            .catch(function (error) {
                onFormErrors(form);
                if (error.response.status === 422) {
                    textFieldError(name, error.response.data.errors.name);
                    textFieldError(description, error.response.data.errors.description);
                    textFieldError(image, error.response.data.errors.image);
                    textFieldError(price, error.response.data.errors.price);
                    textFieldError(seller_id, error.response.data.errors.seller_id);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});
