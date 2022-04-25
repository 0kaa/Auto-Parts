$(document).ready(function () {
    var form = $('#create-company-model-form');

    var name = form.find('#name');
    var company_sector_id = form.find('#company_sector_id');

    form.submit(function (e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        formData.append('name', name.val());
        formData.append('company_sector_id', company_sector_id.val());

        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiDashboardURL + 'company-models',
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
                onFormErrors(form);
                if (error.response.status === 422) {
                    textFieldError(name, error.response.data.errors.name);
                    textFieldError(company_sector_id, error.response.data.errors.company_sector_id);
                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});