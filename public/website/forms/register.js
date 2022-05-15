var lang = $('#lang').attr('lang');



$( "#register" ).validate({

    rules: {
        username: {
            required: true
        },
        first_name: {
            required: true
        },
        last_name: {
            required: true
        },
        password: {
            required: true
        },
        confirm_password: {
            required: true,
            equalTo : "#password",
        },
        email: {
            required: true,
            email: true
        },
        phone: {
            required: true
        },

    },
    messages: {
        confirm_password : {
            equalTo : lang == 'ar' ? 'برجاء ادخال نفس قيمة كلمة المرور' : 'you must password equal confirm password',
        }
    },

    submitHandler:function () {

        var form=$(this);

        var username         = $('#username');
        var first_name       = $('#first_name');
        var last_name        = $('#last_name');
        var email            = $('#email');
        var password         = $('#password');
        var confirm_password = $('#confirm_password');
        var phone            = $('#phone');
        var lat              = $('#lat');
        var lng              = $('#lng');
        var address          = $('#address');

        var formData = new FormData();

        formData.append('username'         , username.val());
        formData.append('first_name'       , first_name.val());
        formData.append('last_name'        , last_name.val());
        formData.append('email'            , email.val());
        formData.append('password'         , password.val());
        formData.append('confirm_password' , confirm_password.val());
        formData.append('phone'            , phone.val());
        formData.append('lat'              , lat.val());
        formData.append('lng'              , lng.val());
        formData.append('address'          , address.val());

        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiWebsiteURL + 'register',
            responseType: 'json',
            data: formData
        })
            .then(function(response) {

                if(response.data.data == 1)
                {

                    sessionStorage.setItem("userId", JSON.stringify(response.data.user_id));
                    sessionStorage.setItem("phone", response.data.phone);

                    var userId = sessionStorage.getItem("userId");
                    var phoneAppend = sessionStorage.getItem("phone");

                    $('#profile-tab').addClass('active');
                    $('.modal').modal({backdrop: 'static', keyboard: false})
                    $('#phone_active').val(phoneAppend);

                    $('#user_id').val(userId);

                } else
                {

                    Swal.fire({
                        type: 'error',
                        title: response.data.error,
                        showConfirmButton: false,
                        timer: 1500

                    });

                }

            })
            .catch(function(error) {

                onFormErrors(form);

                if (error.response.status === 422) {

                    textFieldError(username             , error.response.data.errors.username);
                    textFieldError(first_name             , error.response.data.errors.first_name);
                    textFieldError(last_name              , error.response.data.errors.last_name );
                    textFieldError(email            , error.response.data.errors.email);
                    textFieldError(password         , error.response.data.errors.password);
                    textFieldError(confirm_password , error.response.data.errors.confirm_password);
                    textFieldError(phone            , error.response.data.errors.phone);

                } else if (error.response.status !== 422) {

                    onFormFailure(form);

                }
            });

    }
});

$( "#form-active-code" ).validate({

    rules: {
        code: {
            required: true
        },
    },

    submitHandler:function () {

        var form=$(this);

        var code         = $('#code');
        var phone_active = $('#phone_active');

        var formData = new FormData();

        formData.append('code' , code.val());
        formData.append('phone_active' , phone_active.val());


        axios({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: 'POST',
            url: apiWebsiteURL + 'active',
            responseType: 'json',
            data: formData
        })
        .then(function(response) {

            if(response.data.data == 1)
            {

                $('#register-modal').modal('hide');
                $('#profile-tab').addClass('active');
                $("#profile").tab('show').addClass('active');
                $("#home").removeClass('active');

            } else
            {

                Swal.fire({
                    type: 'error',
                    title: response.data.error,
                    showConfirmButton: false,
                    timer: 1500

                });

            }


        })
        .catch(function(error) {

            onFormErrors(form);

            if (error.response.status === 422) {

                textFieldError(code  , error.response.data.errors.code);

            } else if (error.response.status !== 422) {

                onFormFailure(form);

            }

        });

    }
}); /// end of validation

$( "#resend_code" ).click(function(e){

    e.preventDefault();

    var phonesend =  $('#phone_active').val();
    var action = $(this).data('action');

    $.ajax({
        type: 'GET',
        url: action,
        data: {
            'phone' : phonesend,
        },
        dataType: 'json',
        success: function(result) {

            Swal.fire({
                type: 'success',
                title: result.success,
                showConfirmButton: false,
                timer: 1500

            });

        } // end of success

    }); // end of ajax

}); /// end of resend code

$(document).ready(function(){

        var userId      = sessionStorage.getItem("userId");
        var phoneAppend = sessionStorage.getItem("phone");

        if(userId)
        {

            $('#user_id').val(userId);

        }

        if (phoneAppend) {

            $('#phone_active').val(phoneAppend);

        }


        $("#comapny_register").validate({

            rules: {
                name_enterprise: {
                    required: true
                },
                address: {
                    required: true
                },
                user_name_enterprise: {
                    required: true
                },
                user_identity_enterprise: {
                    required: true
                },
                birth_day_enterprise: {
                    required: true
                },
                image_commerical: {
                    required: true
                },
                number_eban: {
                    required: true
                },
                region_id: {
                    required: true
                },
                city_id: {
                    required: true
                },
                is_company_facility_agent: {
                    required: true
                },
                is_company_facility_authorized_distributor: {
                    required: true
                },
                company_sector_id: {
                    required: true
                },
                add_other_branches: {
                    required: true
                },
                get_type: {
                    required: true
                },
            },

            submitHandler:function () {


                var form= $("#comapny_register");


                var user_id                                     = $('#user_id');
                var name_enterprise                             = $('#name_enterprise');
                var address                                     = $('#user_address');
                var user_name_enterprise                        = $('#user_name_enterprise');
                var user_identity_enterprise                    = $('#user_identity_enterprise');
                var birth_day_enterprise                        = $('#birth_day_enterprise');
                var image_commerical                            = $('#image_commerical')[0].files;
                var number_eban                                 = $('#number_eban');
                var commercial_register_id                      = $('#commercial_register_id');
                var city_id                                     = $('#city_id');
                var is_company_facility_agent                   = $('#is_company_facility_agent');
                var is_company_facility_authorized_distributor  = $('#is_company_facility_authorized_distributor');
                var company_sector_id                           = $('#company_sector_id');
                var add_other_branches                          = $('#add_other_branches');
                var region_id                                   = $('#region_id');
                var get_type                                   = $('#get_type');

                var formData = new FormData();

                var allArea = [];
                $(".array_area").each(function() {
                    allArea.push($(this).val());
                });

                var allCity = [];
                $(".array_city").each(function() {
                    allCity.push($(this).val());
                });

                var allPhone = [];
                $(".array_phone").each(function() {
                    allPhone.push($(this).val());
                });

                var allAddress = [];
                $(".array_address_details").each(function() {
                    allAddress.push($(this).val());
                });

                formData.append('addressarray'                               , allAddress);
                formData.append('phonearray'                                 , allPhone);
                formData.append('areaarray'                                  , allArea);
                formData.append('cityarray'                                  , allCity);
                formData.append('user_id'                                    , user_id.val());
                formData.append('name_company'                               , name_enterprise.val());
                formData.append('address'                                    , address.val());
                formData.append('name_owner_company'                         , user_name_enterprise.val());
                formData.append('national_identity'                          , user_identity_enterprise.val());
                formData.append('date'                                       , birth_day_enterprise.val());
                formData.append('file'                                       , image_commerical[0]);
                formData.append('ibn'                                        , number_eban.val());
                formData.append('commercial_register_id'                     , commercial_register_id.val());
                // formData.append('city'                                       , city_id.val());
                formData.append('is_company_facility_agent'                  , is_company_facility_agent.val());
                formData.append('is_company_facility_authorized_distributor' , is_company_facility_authorized_distributor.val());
                formData.append('company_sector_id'                          , company_sector_id.val());
                formData.append('region_id'                                  , region_id.val());
                formData.append ('city_id'                                   , city_id.val());
                formData.append('other_branches'                             , add_other_branches.val());
                formData.append('activity_type_id'                           , get_type.val());

                if(user_id.val() != 'no')
                {

                    axios({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') , 'Content-Type': 'multipart/form-data'},
                        method: 'POST',
                        url: apiWebsiteURL + 'company',
                        responseType: 'json',
                        data: formData
                    })
                    .then(function(response) {

                        if(response.data.data == 1)
                        {
                            sessionStorage.removeItem("userId");
                            $('#messages-tab').addClass('active');
                            $("#messages").tab('show').addClass('active');
                            $("#profile").removeClass('active');

                        } else
                        {

                            Swal.fire({
                                type: 'error',
                                title: response.data.error,
                                showConfirmButton: false,
                                timer: 1500

                            });

                        }


                    })
                    .catch(function(error) {

                        onFormErrors(form);

                        if (error.response.status === 422) {

                            if(error.response.data.errors.no_active)
                            {

                                $('#text-alert').text(lang == 'ar' ? 'برجاء تأكيد الحساب اولا لتتمكن من اضافه بيانات الشركة الخاصه بك' : 'Please confirm the account first to be able to add your company data');

                                $('.modal').modal({backdrop: 'static', keyboard: false});

                            }

                            textFieldError(user_id  , error.response.data.errors.user_id);
                            textFieldError(name_enterprise  , error.response.data.errors.name_enterprise);
                            textFieldError(user_name_enterprise  , error.response.data.errors.user_name_enterprise);
                            textFieldError(address  , error.response.data.errors.address);
                            textFieldError(user_identity_enterprise  , error.response.data.errors.user_identity_enterprise);
                            textFieldError(birth_day_enterprise  , error.response.data.errors.birth_day_enterprise);
                            textFieldError(image_commerical  , error.response.data.errors.image_commerical);
                            textFieldError(number_eban  , error.response.data.errors.number_eban);
                            textFieldError(commercial_register_id  , error.response.data.errors.commercial_register_id);
                            textFieldError(city_id  , error.response.data.errors.city_id);
                            textFieldError(is_company_facility_agent  , error.response.data.errors.is_company_facility_agent);
                            textFieldError(is_company_facility_authorized_distributor  , error.response.data.errors.is_company_facility_authorized_distributor);
                            textFieldError(company_sector_id  , error.response.data.errors.company_sector_id);
                            textFieldError(region_id  , error.response.data.errors.region_id);
                            textFieldError(add_other_branches  , error.response.data.errors.add_other_branches);
                            textFieldError(get_type  , error.response.data.errors.get_type);


                        } else if (error.response.status !== 422) {

                            onFormFailure(form);

                        }

                    });

                } else
                {

                    Swal.fire({

                        type: 'error',
                        title: 'من فضلك قم بأدخال البيانات الشخصية اولا',
                        showConfirmButton: true,

                    });

                }

            }
        });

});
