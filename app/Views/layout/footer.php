<!-- JQuery -->
<script type="text/javascript" src="/jquery/jquery.min.js"></script>

<!-- Bootstrap JavaScript-->
<script type="text/javascript" src="/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap-select JavaScript -->
<script type="text/javascript" src="/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" src="/datatables/datatables.min.js"></script>

<!-- SweetAlert JavaScript -->
<script type="text/javascript" src="/sweetalert/sweetalert/sweetalert.min.js"></script>

<!-- Custom JavaScript -->
<script type="text/javascript" src="/js/javascript.js"></script>

<!-- Number Only Script -->
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    // Live Select Option Cabang Script
    $("#select_cabang").change(function() {
        var select = $(this).val();
    });
</script>

</body>

</html>