$(document).ready(function () {
    var form = $('#create-packages-form');

    var name_ar = form.find('#name_ar');
    var name_en = form.find('#name_en');
    var description_ar = form.find('#description_ar');
    var description_en = form.find('#description_en');
    var badge = form.find('#badge');
    var price = form.find('#price');
    var discount = form.find('#discount');
    var duration_ar = form.find('#duration_ar');
    var duration_en = form.find('#duration_en');
    var keyword_ar = form.find('#keyword_ar');
    var keyword_en = form.find('#keyword_en');



    form.submit(function (e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();
        formData.append('name_ar', name_ar.val());
        formData.append('name_en', name_en.val());
        formData.append('description_ar', description_ar.val());
        formData.append('description_en', description_en.val());
        ifFileFoundAppend('badge', badge[0], formData);
        formData.append('price', price.val());
        formData.append('discount', discount.val());
        formData.append('duration_ar', duration_ar.val());
        formData.append('duration_en', duration_en.val());
        formData.append('keyword_ar', keyword_ar.val());
        formData.append('keyword_en', keyword_en.val());
        
        var allFeatures = [];
        $(".array_features").each(function () {
            allFeatures.push($(this).val());
        });

        formData.append('featuresarray', allFeatures);



        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiDashboardURL + 'packages',
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
                    textFieldError(name_ar, error.response.data.errors.name_ar);
                    textFieldError(name_en, error.response.data.errors.name_en);
                    textFieldError(description_ar, error.response.data.errors.description_ar);
                    textFieldError(description_en, error.response.data.errors.description_en);
                    textFieldError(badge, error.response.data.errors.badge);
                    textFieldError(price, error.response.data.errors.price);
                    textFieldError(discount, error.response.data.errors.discount);
                    textFieldError(duration_ar, error.response.data.errors.duration_ar);
                    textFieldError(duration_en, error.response.data.errors.duration_en);
                    textFieldError(keyword_ar, error.response.data.errors.keyword_ar);
                    textFieldError(keyword_en, error.response.data.errors.keyword_en);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});