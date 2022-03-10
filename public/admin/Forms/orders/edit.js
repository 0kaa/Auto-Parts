$(document).ready(function () {
    var form = $("#update-order-form");
    var order_number = form.find("#order_number");
    var order_ship_name = form.find("#order_ship_name");
    var order_ship_address = form.find("#order_ship_address");
    var order_ship_phone = form.find("#order_ship_phone");
    var shipping = form.find("#shipping_id");
    var payment = form.find("#payment_id");
    var order_status = form.find("#order_status");

    form.submit(function (e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        formData.append("order_number", order_number.val());
        formData.append("order_ship_name", order_ship_name.val());
        formData.append("order_ship_address", order_ship_address.val());
        formData.append("order_ship_phone", order_ship_phone.val());
        formData.append("shipping_id", shipping.val());
        formData.append("payment_id", payment.val());
        formData.append("order_status_id", order_status.val());


        formData.append("_method", "PATCH");

        axios({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "POST",
            url:
                apiDashboardURL +
                "orders/" +
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
                    textFieldError(order_number, error.response.data.errors.order_number);
                    textFieldError(order_ship_name, error.response.data.errors.order_ship_name);
                    textFieldError(order_ship_address, error.response.data.errors.order_ship_address);
                    fileFieldError(order_ship_phone, error.response.data.errors.order_ship_phone);
                    textFieldError(shipping, error.response.data.errors.shipping_id);
                    textFieldError(payment, error.response.data.errors.payment_id);
                    textFieldError(order_status, error.response.data.errors.order_status_id);

                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});
