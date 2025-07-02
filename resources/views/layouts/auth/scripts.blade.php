<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="{{ asset('admin') }}/assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/js/bootstrap.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/hammer/hammer.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/i18n/i18n.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('admin') }}/assets/vendor/libs/@form-validation/popular.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/@form-validation/auto-focus.js"></script>

<script src="{{ asset('admin/assets/vendor/libs/select2/select2.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('admin') }}/assets/js/main.js"></script>

<script>
    $(document).ready(function() {
        var select2 = $('.select2');
        if (select2.length) {
            select2.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Select value',
                    dropdownParent: $this.parent()
                });
            });
        }
    });
</script>

<!-- Page JS -->
