<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Universitas Bengkulu </b>
    </div>
    <strong>Copyright &copy; 2014-2019 AdminLTE</a>.</strong>
</footer>
<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>template/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>template/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>template/dist/js/demo.js"></script>
<script src="<?php echo base_url() ?>template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>template/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>template/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url() ?>template/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pass').hide();
        $("#hide").click(function() {
            $("#pass").hide();
            $('#password').val('0');
        });
        $("#show").click(function() {
            $("#pass").show();
            $('#password').val('')
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.sidebar-menu').tree()
    })
</script>
<script>
    $(function() {
        $('#example2').DataTable()
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>
<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    })
</script>
<script>
    $(document).ready(function() {
        $('.sidebar-menu').tree()
    })
    $('#reservation1').daterangepicker()
    $('#reservation2').daterangepicker()
</script>
<script>
    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    })
</script>
<!-- CK Editor -->
<script src="<?php echo base_url() ?>template/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
</script>
<script>
    //Add a JQuery click event handler onto our checkbox.
    $('#terms_and_conditions').click(function() {
        //If the checkbox is checked.
        if ($(this).is(':checked')) {
            //Enable the submit button.
            $('#submit_button').attr("disabled", false);
        } else {
            //If it is not checked, disable the button.
            $('#submit_button').attr("disabled", true);
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".add-more").click(function() {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
        });
    });
</script>