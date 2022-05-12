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

        var price = form.find("#price");
        var shipping = form.find("#shipping_id");
        var payment = form.find("#payment_id");
        var order_status = form.find("#order_status");
        var payment_url = form.find("#payment_url");


        formData.append("price", price.val());
        formData.append("shipping_id", shipping.val());
        formData.append("payment_id", payment.val());
        formData.append("order_status_id", order_status.val());
        formData.append("payment_url", payment_url.val());


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

                    textFieldError(price, error.response.data.errors.price);
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
