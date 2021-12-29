<!-- BEGIN: Vendor JS-->
<script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
<!-- BEGIN Vendor JS-->

<script>
@if(app()->isLocale('ar'))

        $('.table').DataTable({
            "language": {
//            for arabic language
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
        });

    @else
    $('table').DataTable();

@endif
</script>

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>

<script src="{{asset('admin/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('admin/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('admin/app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('admin/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
<script src="{{asset('admin/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>

<script src="{{ asset('admin/app-assets/js/scripts/customizer.min.js') }}"></script>

<script src="{{ asset('admin/Forms/notifications/notifications.js') }}"></script>

<!-- END: Page JS-->

{{-- Alerts start --}}

@if (session()->has('success'))
    <script>
        toastr['success']('{{ session('success') }}', 'Success!', {
            closeButton: true,
            tapToDismiss: false,
            // rtl: isRtl
        });

        '{{ session()->forget('success') }}';

    </script>
@endif


@if (session()->has('warning'))
    <script>
        toastr['warning']('{{ session('warning') }}', 'Warning!', {
            closeButton: true,
            tapToDismiss: false,
            // rtl: isRtl
        });
        '{{ session()->forget('warning') }}';

    </script>
@endif


@if (session()->has('error'))
    <script>
        toastr['error']('{{ session('error') }}', 'Error!', {
            closeButton: true,
            tapToDismiss: false,
            // rtl: isRtl
        });
        '{{ session()->forget('error') }}';

    </script>
@endif


@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr['error']('{{ $error }}', 'Error!', {
                closeButton: true,
                tapToDismiss: false,
                // rtl: isRtl
            });

        </script>
    @endforeach
@endif

{{-- Alerts end --}}

<script type="text/javascript" src="{{ URL::asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('admin/plugins/axios/dist/axios.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/Forms/requests-and-validations.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/Forms/apiURLs.js') }}"></script>
<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
    window.apiWebsiteURL = `{{ config('app.website') }}`;
    window.apiDashboardURL = `{{ config('app.dashboard') }}`;

</script>

@stack('js')


