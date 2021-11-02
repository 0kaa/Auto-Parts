<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="{{asset('website/js/bootstrap.min.js')}}"></script>
<script src="{{asset('website/js/wow.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('website/js/custom.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/plugins/axios/dist/axios.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/Forms/apiURLs.js') }}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('admin/Forms/requests-and-validations.js') }}"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

@yield('scripts')


@if(session('error'))

<script>

    swal.fire({

        title: "{{ session('error') }}",
        type: 'error',
        showConfirmButton: true,
        
    });  

</script>

@endif

@if(session('success'))

<script>

swal.fire({

    title: "{{ session('success') }}",
    type: 'success',
    showConfirmButton: true,

});  

</script>

@endif

