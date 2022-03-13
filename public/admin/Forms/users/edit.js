$(document).ready(function () {
    var form = $("#update-user-form");
    var name = form.find("#name");
    var email = form.find("#email");
    var phone = form.find("#phone");
    var password = form.find("#password");
    // var confirm_password = form.find("#confirm_password");
    var type_user = form.find("#type_user");
    var activity_type_id = form.find("#activity_type_id");
    var name_company = form.find("#name_company");
    var name_owner_company = form.find("#name_owner_company");
    var national_identity = form.find("#national_identity");
    var date = form.find("#date");
    var file = form.find("#file");
    var ibn = form.find("#ibn");
    var region_id = form.find("#region_id");
    var city_id = form.find("#city_id");
    var is_company_facility_agent = form.find("#is_company_facility_agent");
    var is_company_facility_authorized_distributor = form.find(
        "#is_company_facility_authorized_distributor"
    );
    var company_sector_id = form.find("#company_sector_id");
    var image = form.find("#image");
    var searchInput = form.find("#searchInput");
    var address = form.find("#address");
    var latitude = form.find("#lat");
    var longitude = form.find("#lng");

    form.submit(function (e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        formData.append("name", name.val());
        formData.append("email", email.val());
        formData.append("phone", phone.val());
        formData.append("password", password.val());
        // formData.append("confirm_password", confirm_password.val());
        formData.append("type_user", type_user.val());
        formData.append("activity_type_id", activity_type_id.val());
        formData.append("name_company", name_company.val());
        formData.append("name_owner_company", name_owner_company.val());
        formData.append("national_identity", national_identity.val());
        formData.append("ibn", ibn.val());
        formData.append("city_id", city_id.val());
        formData.append("region_id", region_id.val());
        formData.append(
            "is_company_facility_agent",
            is_company_facility_agent.val()
        );
        formData.append(
            "is_company_facility_authorized_distributor",
            is_company_facility_authorized_distributor.val()
        );
        formData.append("company_sector_id", company_sector_id.val());
        formData.append("address", address.val());
        if (date.val() != undefined) {
            formData.append("date", date.val());
        }

        formData.append("searchInput", searchInput.val());
        formData.append("lat", latitude.val());
        formData.append("lng", longitude.val());
        ifFileFoundAppend("image", image[0], formData);
        ifFileFoundAppend("file", file[0], formData);

        formData.append("_method", "PATCH");

        axios({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "POST",
            url:
                apiDashboardURL +
                "users/" +
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
                    textFieldError(name, error.response.data.errors.name);
                    textFieldError(email, error.response.data.errors.email);
                    textFieldError(phone, error.response.data.errors.phone);
                    fileFieldError(image, error.response.data.errors.image);
                    textFieldError(type, error.response.data.errors.type);
                    textFieldError(
                        password,
                        error.response.data.errors.password
                    );
                    textFieldError(
                        confirm_password,
                        error.response.data.errors.confirm_password
                    );
                    textFieldError(
                        address,
                        error.response.data.errors.searchInput
                    );
                } else if (error.response.status !== 422) {
                    onFormFailure(form);
                }
            });
    });
});
