$(document).on("change", "#add_other_branches", function () {

    var id = $(this).val();

    if (id == 1) {
        $(".hidden-item").attr("hidden", false);
    } else {
        $('#append_branches').html('');
        $(".hidden-item").attr("hidden", true);
    }
});

var lang = $("#lang").attr("lang");

if (lang == "ar") {
    var city = "المدينة";
    var area = "المنطقة";
    var phone = "رقم الجوال";
    var address_details = "العنوان بالتفصيل";
    var add_branches = "اضافة فرع";
    var delete_branch = "حذف الفرع";
} else {
    var delete_branch = "Delete Branche";
    var area = "Area";
    var add_branches = "Add Branches";
    var address_details = "Details Address";
    var phone = "Phone Number";
    var city = "City";
}



var i = 1;
$(document).on("click", ".click-plus", function () {
    var action = $(this).data("action");

    $.ajax({
        type: "GET",
        url: action,
        data: {},
        dataType: "json",
        success: function (result) {
            var append = `<div class="remove-this"> <div class="add-divs">
                          <div class="click-add-res click-minus">
                          <span>-</span>
                          ${delete_branch}
                          </div>
                          <div class="shep-div">

                          </div>
                        </div><div class="sub-more-input">
                        <div class="input-sub-regester form-group">
                            <select class="form-select form-control array_area" name="area_${i}" aria-label="Default select example" required>
                                <option selected value=""> ${area}</option>`;
            result.areas.forEach((option) => {
                append += `<option value="${option.id}">${
                    lang == "ar" ? option.name_ar : option.name_en
                }</option>`;
            });

            append += `</select>
                        </div>


                        <div class="input-sub-regester form-group">
                        <select class="form-select form-control array_city" name="city_${i}" aria-label="Default select example" required>
                            <option selected value=""> ${city}</option>`;
            result.cities.forEach((option) => {
                append += `<option value="${option.id}">${
                    lang == "ar" ? option.name_ar : option.name_en
                }</option>`;
            });

            append += `</select>
                        </div>


                        <div class="input-sub-regester form-group">
                            <input type="tel" name="phone_${i}" class="form-control array_phone" placeholder="${phone}" required>
                        </div>
                        <div class="input-sub-regester form-group">
                            <input type="text" name="address_details_${i}" class="form-control array_address_details" placeholder="${address_details}" required>
                        </div>

                    </div>
                    </div>
                    `;
            i++;
            $("#append_branches").append(append);
        }, // end of success
    }); // end of ajax
});

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

    var add_other_branches = $("#add_other_branches");



    form.submit(function (e) {
        e.preventDefault();
        onFormSubmit(form);
        var formData = new FormData();

        var allArea = [];
        $(".array_area").each(function () {
            allArea.push($(this).val());
        });

        var allCity = [];
        $(".array_city").each(function () {
            allCity.push($(this).val());
        });

        var allPhone = [];
        $(".array_phone").each(function () {
            allPhone.push($(this).val());
        });

        var allAddress = [];
        $(".array_address_details").each(function () {
            allAddress.push($(this).val());
        });


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

        formData.append("addressarray", allAddress);
        formData.append("phonearray", allPhone);
        formData.append("areaarray", allArea);
        formData.append("cityarray", allCity);
        formData.append("other_branches", add_other_branches.val());

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
