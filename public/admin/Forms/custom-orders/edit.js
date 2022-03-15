$(document).ready(function () {

    $("#activity_type_id").change(function (e) {
        e.preventDefault();

        var url = $(this).data('action');

        var id = $(this).val();

        $('#append_sub_activity').html('');
        $('#append_sub_sub_activity').html('');

        $.ajax({
            type: "GET",
            url: url,
            data: {'id' : id},
            success: function (response) {

                $('#append_sub_activity').html(response);

            }
        });
    });

    $(document).on("change", "#sub_activity_id",function (e) {
        e.preventDefault();

        var url = $(this).data('action');

        var id = $(this).val();

        $('#append_sub_sub_activity').html('');

        $.ajax({
            type: "GET",
            url: url,
            data: {'id' : id},
            success: function (response) {
                $('#append_sub_sub_activity').html(response);

            }
        });
    });




    var form = $("#update-custom-order-form");

    form.submit(function (e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        var piece_name = form.find("#piece_name");
        var piece_description = form.find("#piece_description");
        var piece_price = form.find("#piece_price");
        var note = form.find("#note");
        var quantity = form.find("#quantity");
        var car = form.find("#car_id");
        var activity_type = form.find("#activity_type_id");
        var sub_activity = form.find("#sub_activity_id");
        var sub_sub_activity = $("#sub_sub_activity_id");
        var shipping = form.find("#shipping_id");
        var payment = form.find("#payment_id");
        var order_status = form.find("#order_status");
        var payment_url = form.find("#payment_url");
        var piece_image = form.find('#piece_image');
        var form_image = form.find('#form_image');

            console.log(sub_sub_activity.val());


        formData.append("piece_name", piece_name.val());
        formData.append("piece_description", piece_description.val());
        formData.append("piece_price", piece_price.val());
        formData.append("note", note.val());
        formData.append("quantity", quantity.val());
        formData.append("car_id", car.val());
        formData.append("activity_type_id", activity_type.val());
        formData.append("sub_activity_id", sub_activity.val());
        formData.append("sub_sub_activity_id", sub_sub_activity.val());
        formData.append("shipping_id", shipping.val());
        formData.append("payment_id", payment.val());
        formData.append("order_status_id", order_status.val());
        formData.append("payment_url", payment_url.val());
        ifFileFoundAppend('piece_image', piece_image[0], formData);
        ifFileFoundAppend('form_image', form_image[0], formData);


        formData.append("_method", "PATCH");

        axios({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "POST",
            url:
                apiDashboardURL +
                "custom_orders/" +
                document.location.href.split("/")[5],
            responseType: "json",
            data: formData,
        })
            .then(function (response) {
                toastr["success"](response.data.success, "Success!", {
                    closeButton: true,
                    tapToDismiss: false,
                });
                onFormSuccess(form, false);
            })
            .catch(function (error) {
                onFormErrors(form);
                if (error.response.status === 422) {

                    textFieldError(piece_name, error.response.data.errors.piece_name);
                    textFieldError(piece_description, error.response.data.errors.piece_description);
                    textFieldError(piece_price, error.response.data.errors.piece_price);
                    fileFieldError(note, error.response.data.errors.note);
                    fileFieldError(quantity, error.response.data.errors.quantity);
                    fileFieldError(car, error.response.data.errors.car_id);
                    fileFieldError(activity_type, error.response.data.errors.activity_type_id);
                    fileFieldError(sub_activity, error.response.data.errors.sub_activity_id);
                    fileFieldError(sub_sub_activity, error.response.data.errors.sub_sub_activity_id);
                    fileFieldError(piece_image, error.response.data.errors.piece_image);
                    fileFieldError(form_image, error.response.data.errors.form_image);
                    textFieldError(shipping, error.response.data.errors.shipping_id);
                    textFieldError(payment, error.response.data.errors.payment_id);
                    textFieldError(order_status, error.response.data.errors.order_status_id);
                    textFieldError(payment_url, error.response.data.errors.payment_url);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});
