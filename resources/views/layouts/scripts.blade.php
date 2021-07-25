<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/js/detect.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/vertical-menu.js') }}"></script>
<script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>

<!-- Sweet-Alert js -->
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-sweet-alert.js') }}"></script>

<!-- Custom Switchery js -->
<script src="{{ asset('assets/js/custom/custom-switchery.js') }}"></script>

<!-- Datepicker JS -->
<script src="{{ asset('assets/plugins/datepicker/datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datepicker/i18n/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-form-datepicker.js') }}"></script>

<!-- mix -->
<script src="{{ asset('js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        @if (Session::has('successMessage'))
            showSuccess("{{ Session::get('successMessage') }}");
        @endif

        @if (!$errors->isEmpty())
            showError("{{ $errors->first() }}");
        @endif
    });

    function showSuccess(message) {
        $('#success-toast-text').html(message);
        $("#succes-toast").toast({
            delay: 5000
        }).toast("show");
    }

    function showError(message) {
        $('#error-toast-text').html(message);
        $("#error-toast").toast({
            delay: 5000
        }).toast("show");
    }
</script>

@yield('script')
<!-- Core JS -->
<script src="{{ asset('assets/js/core.js') }}"></script>
