$(document).ready(function() {
    var form = $('#update-static-page-form');

    var descr_en = CKEDITOR.instances.descr_en;
    var descr_ar = CKEDITOR.instances.descr_ar;
    var image = form.find('#image');
    var sub_image = form.find('#sub_image');
  var main_image_home = form.find('#main_image_home');
    var sub_image_home = form.find('#sub_image_home');

    form.submit(function(e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        formData.append('desc_ar',CKEDITOR.instances.descr_ar.getData());
        formData.append('desc_en',CKEDITOR.instances.descr_en.getData());
        ifFileFoundAppend('main_image', image[0], formData);
        ifFileFoundAppend('sub_image', sub_image[0], formData);
        ifFileFoundAppend('main_image_home', main_image_home[0], formData);
        ifFileFoundAppend('sub_image_home', sub_image_home[0], formData);

        formData.append('_method', 'PATCH');

        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiDashboardURL + 'static-pages/'+ document.location.href.split('/')[5],
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

                    ckEditorFieldError($('#descr_ar'), descr_ar, error.response.data.errors.descr_ar);
                    ckEditorFieldError($('#descr_en'), descr_en, error.response.data.errors.descr_en);
                    fileFieldError(image, error.response.data.errors.main_image);
                    fileFieldError(sub_image, error.response.data.errors.sub_image);
                    fileFieldError(main_image_home, error.response.data.errors.main_image_home);
                    fileFieldError(sub_image_home, error.response.data.errors.sub_image_home);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});