<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Jadwal</u>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username" style="text-align: center;"><?= $data->nama_mhs ?> | <?= $data->npm ?></h3>
                    <h4 class="widget-user-desc" style="text-align: center;">-</h5>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <i class="fa fa-calendar"></i>
                                <h5 class="description-header">Jadwal Seminar</h5>
                                <span class="description-text"> - </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <i class="fa fa-user"></i>
                                <h5 class="description-header">Dosen Penguji 1</h5>
                                <span class="description-text"> - </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <div class="description-block">
                                <i class="fa fa-user"></i>
                                <h5 class="description-header">Dosen Pembimbing</h5>
                                <span class="description-text">-</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-6">
                            <div class="description-block">
                                <i class="fa fa-user"></i>
                                <h5 class="description-header">Dosen Penguji 2</h5>
                                <span class="description-text"> - </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>