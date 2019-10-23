<!--   Core JS Files   -->

<script src="<?php echo BASE_PATH; ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/plugins/bootstrap-notify.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/fullcalendar.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-material-design.min.js"></script>

<script>
    $(document).ready(function () {
        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    });

    $('.datetimepicker').datetimepicker({
        format: 'DD MMMM YYYY'
    });
   
</script>
