// wow
new WOW().init();

// Aos
AOS.init();



$(window).on("load",function(){
  $("#loader").hide(5000)
});



//input validation 
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();



$("#times-ican").click(function() {
  $(this).toggleClass("active");
  $("#menu-div").toggleClass("active")

})

var $winl = $(window); // or $box parent container
var $boxl = $("#menu-div, #times-ican");
$winl.on("click.Bst", function(event) {
  if (
      $boxl.has(event.target).length === 0 && //checks if descendants of $box was clicked
      !$boxl.is(event.target) //checks if the $box itself was clicked
  ) {
      $("#menu-div").removeClass("active")
      $("#times-ican").removeClass("active")
  }
});

$('#owl-demo').owlCarousel({
    loop:true, 
    margin:10,
    dots: false,
  //   nav:true,
    responsiveClass:true,
    rtl:true,
    // center:true,
    autoplay:true,
    responsive:{
        0:{
            items:1,
            
        },
        600:{
            items:2,
        },
        1000:{
            items:4,
        }
    }
  })


  

$('#owl-demo1').owlCarousel({
  loop:true, 
  margin:0,
  dots: false,
//   nav:true,
  responsiveClass:true,
  rtl:true,
  // center:true,
  // autoplay:true,
  responsive:{
      0:{
          items:1,
          
      },
      600:{
          items:2,
      },
      1000:{
          items:4,
      }
  }
})


//silder-index
$('#slider-1').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    items: 1, 
    rtl: true,
    autoplay: true,
    dots: false,
    responsiveClass:true,
    responsive:{
      1400: {
        item:1,
      }
    }
  });
  

  const animationDuration = 4000;

const frameDuration = 1000 / 60;

const totalFrames = Math.round(animationDuration / frameDuration);

const easeOutQuad = (t) => t * (2 - t);

const animateCountUp = (el) => {
  let frame = 0;
  const countTo = parseInt(el.innerHTML, 10);

  const counter = setInterval(() => {
    frame++;

    const progress = easeOutQuad(frame / totalFrames);

    const currentCount = Math.round(countTo * progress);

    if (parseInt(el.innerHTML, 10) !== currentCount) {
      el.innerHTML = currentCount;
    }

    if (frame === totalFrames) {
      clearInterval(counter);
    }
  }, frameDuration);
};

const countupEls = document.querySelectorAll(".timer");
countupEls.forEach(animateCountUp);


//-----
$('#owl-demo').owlCarousel({
  loop:true, 
  margin:10,
  dots: false,
//   nav:true,
  responsiveClass:true,
  rtl:true,
  autoplay:true,
  responsive:{
      0:{
          items:2,
          
      },
      600:{
          items:3,
      },
      1000:{
          items:4,
      }
  }
})




$(window).on("load",function(){
  setTimeout(() => {
      $(".loading").addClass('box')
      $(".loader1").addClass('box')
      $(".over_lay").addClass('box1')

  }, 3900);
});



    // preview image 1
    function readURL(input) {

      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {

              imgId = '.preview-' + $(input).attr('id');

              $(imgId).attr('src', e.target.result);


              $('.prev').show();

          }

          reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
  }

  $(document).on( 'change' , '.image' ,function() {

      readURL(this);

  });


  // $('#active-code').click(function(){
  
  
  //     $('#profile-tab').addClass('active');

  //     $('.modal').modal('hide');
  // });

  // $('#send-code').click(function(){
  
  
  //     $('#profile-tab').addClass('active');

  //     $('.modal').modal({backdrop: 'static', keyboard: false})  
  // });

  var lang = $('#lang').attr('lang');

  if(lang == 'ar')
  {
  
      var city = 'المدينة';
      var area = 'المنطقة';
      var phone = 'رقم الجوال';
      var address_details = 'العنوان بالتفصيل';
      var add_branches = 'اضافة فرع';
      var delete_branch = 'حذف الفرع';
      
    } else 
    {
      
      var delete_branch = 'Delete Branche';
      var area = 'Area';
      var add_branches = 'Add Branches';
      var address_details = 'Details Address';
      var phone = 'Phone Number';
      var city = 'City';
  
  
  }  
var i = 1;
$(document).on('click' , '.click-plus' , function(){

    var action = $(this).data('action');

    $.ajax({
        type: 'GET',
        url: action,
        data: {},
        dataType: 'json',
        success: function(result) {

          var append = `<div class="remove-this"> <div class="add-divs">
                          <div class="click-add-res click-minus">
                          <span>-</span>
                          ${delete_branch}
                          </div>
                          <div class="shep-div">
      
                          </div>
                        </div><div class="sub-more-input">
                        <div class="input-sub-regester">
                            <select class="form-select form-control array_area" name="area_${i}" aria-label="Default select example" required>
                                <option selected value=""> ${area}</option>`;
                                result.data.forEach(option => {

                                  append += `<option value="${option.id}">${lang == 'ar' ? option.name_ar : option.name_en}</option>`;

                                });
      
                        append += `</select> 
                        </div>
                        
                        
                        <div class="input-sub-regester">
                            <input type="text" name="city_${i}" class="form-control array_city" placeholder="${city}" required>
                        </div>
      
      
                        <div class="input-sub-regester">
                            <input type="tel" name="phone_${i}" class="form-control array_phone" placeholder="${phone}" required>
                        </div>
                        <div class="input-sub-regester">
                            <input type="text" name="address_details_${i}" class="form-control array_address_details" placeholder="${address_details}" required>
                        </div>
      
                    </div>             
                    </div>              
                    `;
                    i++;
          $('#append_branches').append(append); 


        } // end of success

    }); // end of ajax   


    
});


$(document).on('click' , '.click-minus' , function(){
  $(this).closest('.remove-this').remove();
});
$(document).on('click' , '.click-minus-two' , function(){
  $(this).closest('.remove-this').remove();
});

 


  $(document).on('change' , '#add_other_branches' , function(){

    // $('#append_branches').html('');

    var id   = $(this).val();

    if (id == 1) 
    {
        
      $(".hidden-item").attr("hidden",false);
      
    } else 
    {

      $(".hidden-item").attr("hidden",true);

    }  

});


