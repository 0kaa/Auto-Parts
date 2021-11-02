
var lang = $('#lang').attr('lang');

if(lang == 'ar')
{

    var city = 'المدينة';
    var phone = 'رقم الجوال';
    var address_details = 'العنوان بالتفصيل';
    var add_branches = 'اضافة فرع';
    
} else 
{
    
    var add_branches = 'Add Branches';
    var address_details = 'Details Address';
    var phone = 'Phone Number';
    var city = 'City';


}

$('#get_type').change(function(){

    var type   = $(this).find(':selected').data('type');
    var action = $(this).data('action');

    $.ajax({
        type: 'GET',
        url: action,
        data: {
            'type' : type,
        },
        dataType: 'html',
        success: function(result) {

            $('#get-all-input').html(result);

        } // end of success

    }); // end of ajax         

});

