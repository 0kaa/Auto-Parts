$(document).ready(function () {
    var form = $('#update-faqs-form');

    var question_en = form.find('#question_en');
    var question_ar = form.find('#question_ar');
    var answer_en = form.find('#answer_en');
    var answer_ar = form.find('#answer_ar');

    form.submit(function (e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        formData.append('question_en', question_en.val());
        formData.append('question_ar', question_ar.val());
        formData.append('answer_en', answer_en.val());
        formData.append('answer_ar', answer_ar.val());

        formData.append('_method', 'PATCH');

        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiDashboardURL + 'faqs/' + document.location.href.split('/')[5],
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
                    textFieldError(question_en, error.response.data.errors.question_en);
                    textFieldError(question_ar, error.response.data.errors.question_ar);
                    textFieldError(answer_ar, error.response.data.errors.answer_ar);
                    fileFieldError(answer_en, error.response.data.errors.answer_en);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});