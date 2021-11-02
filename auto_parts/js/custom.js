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


  $('#active-code').click(function(){
  
  
      $('#profile-tab').addClass('active');

      $('.modal').modal('hide');
  });

  $('#send-code').click(function(){
  
  
      $('#profile-tab').addClass('active');

      $('.modal').modal({backdrop: 'static', keyboard: false})  
  });

$(document).on('click' , '.click-plus' , function(){


    $(this).removeClass('click-plus');
    $(this).addClass('click-minus');
    $(this).find('span').text('-')

    var append = `<div class="remove-this"><div class="sub-more-input">
                  <div class="input-sub-regester">
                      <select class="form-select form-control " aria-label="Default select example" required>
                          <option selected> المنطقة</option>
                          <option value="1">الرياض  </option>
                          <option value="2">مكة  </option>
                          <option value="3">المندينة المنوره  </option>
                          <option value="4"> المنطقة الشرقية  </option>

                      </select> 
                  </div>
                  
                  
                  <div class="input-sub-regester">
                      <input type="text" class="form-control" placeholder="المدينة  ">
                  </div>


                  <div class="input-sub-regester">
                      <input type="tel" class="form-control" placeholder="رقم الجوال  ">
                  </div>
                  <div class="input-sub-regester">
                  <input type="text" class="form-control" placeholder="موقع المنشأة / المحل">
                </div>

              </div>
              <div class="add-divs">
                  <div class="click-add-res click-plus-two">
                    <span>+</span>
                    إضافة فرع
                  </div>
                  <div class="shep-div">

                  </div>
              </div>              
              </div>              
              `;
    $('.more_inputs').append(append); 

    
});

$(document).on('click' , '.click-plus-two' , function(){


    $(this).removeClass('click-plus-two');
    $(this).addClass('click-minus-two');
    $(this).find('span').text('-')

    var append = `<div class="remove-this"><div class="sub-more-input">
                  <div class="input-sub-regester">
                      <select class="form-select form-control " aria-label="Default select example" required>
                          <option selected> المنطقة</option>
                          <option value="1">الرياض  </option>
                          <option value="2">مكة  </option>
                          <option value="3">المندينة المنوره  </option>
                          <option value="4"> المنطقة الشرقية  </option>

                      </select> 
                  </div>
                  
                  
                  <div class="input-sub-regester">
                      <input type="text" class="form-control" placeholder="المدينة  ">
                  </div>


                  <div class="input-sub-regester">
                      <input type="tel" class="form-control" placeholder="رقم الجوال  ">
                  </div>

                  <div class="input-sub-regester">
                    <input type="text" class="form-control" placeholder="موقع المنشأة / المحل">
                  </div>

              </div>
              <div class="add-divs">
                  <div class="click-add-res click-plus-two">
                    <span>+</span>
                    إضافة فرع
                  </div>
                  <div class="shep-div">

                  </div>
              </div>              
              </div>              
              `;
    $('.more_inputs').append(append); 

    
});
  

  $(document).on('click' , '.click-minus' , function(){
    $('.remove-this').first().remove();
    if ($('.remove-this').length == 0) {
      $(this).find('span').text('+');

      $(this).removeClass('click-minus');
      $(this).addClass('click-plus');
      
    }
  });
  $(document).on('click' , '.click-minus-two' , function(){
    $(this).closest('.remove-this').remove();
  });

  $('#done-register').click(function(){
      $('#messages-tab').addClass('active')
  });