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

    $(document).on("change", "#car_id",function (e) {
        e.preventDefault();

        var url = $(this).data('action');

        var id = $(this).val();

        $('#car_model_id').html('');

        $.ajax({
            type: "GET",
            url: url,
            data: {'id' : id},
            success: function (response) {
                $('#car_model_id').html(response);

            }
        });
    });

});
