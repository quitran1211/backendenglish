<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}", "Thông báo");
    @endif
    @if (session('info'))
        toastr.info("{{ session('info') }}", "Thông báo");
    @endif
    @if (session('warning'))
        toastr.warning("{{ session('warning') }}", "Thông báo");
    @endif
    @if (session('error'))
        toastr.error("{{ session('error') }}", "Thông báo");
    @endif
</script>
