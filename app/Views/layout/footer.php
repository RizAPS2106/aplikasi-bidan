<!-- JQuery -->
<script type="text/javascript" src="/jquery/jquery.min.js"></script>

<!-- JQuery Mask -->
<script type="text/javascript" src="/jquery-mask/jquery.mask.js"></script>

<!-- Bootstrap JavaScript-->
<script type="text/javascript" src="/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" src="/datatables/datatables.min.js"></script>

<!-- SweetAlert JavaScript -->
<script type="text/javascript" src="/sweetalert/sweetalert/sweetalert.min.js"></script>

<!-- Select2 Javascript -->
<script type="text/javascript" src="/select2/dist/js/select2.full.min.js"></script>

<!-- Datetime Picker JavaScript -->
<script src="/datetimepicker/js/bootstrap-datetimepicker.js"></script>

<!-- Datetime Picker Languages -->
<script src="/datetimepicker/js/locales/bootstrap-datetimepicker.id.js"></script>

<!-- Custom JavaScript -->
<script type="text/javascript" src="/js/script.js"></script>

<!-- Number Only Script -->
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    $('.uang').mask('000.000.000.000', {
        reverse: true
    });
</script>

</body>

</html>