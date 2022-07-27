<body class="hold-transition skin-blue sidebar-mini">
    <?php if ($cek == 0) { ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <div class="callout callout-danger">
                    <p>Anda belum mempunyai jadwal seminar ! </p>
                </div>
            </section>
        </div>
    <?php } elseif ($cekk == 0) { ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <div class="callout callout-danger">
                    <p>Anda belum mempunyai jadwal seminar ! </p>
                </div>
            </section>
        </div>
    <?php } elseif ($cekkk == 0) { ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <div class="callout callout-danger">
                    <p>Anda belum mempunyai jadwal seminar ! </p>
                </div>
            </section>
        </div>
    <?php } else { ?>
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
                        <h4 class="widget-user-desc" style="text-align: center;"><?= $data->judul ?></h5>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <i class="fa fa-calendar"></i>
                                    <h5 class="description-header">Jadwal Seminar</h5>
                                    <?php if ($data->r_seminar == null) {
                                    ?><span class="description-text"> - </span> <?php } else { ?>
                                        <span class="description-text"> <?php $date_s = date_create($data->tgl_seminar);
                                                                                echo date_format($date_s, 'd-m-Y'); ?> | <?= $data->r_seminar ?> | <?= $data->wkt_seminar ?></span>
                                    <?php } ?>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <i class="fa fa-user"></i>
                                    <h5 class="description-header">Dosen Penguji 1</h5>
                                    <?php $peng1 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$data->peng1'")->row(); ?>
                                    <span class="description-text"><?= $peng1->nama ?></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <div class="description-block">
                                    <i class="fa fa-user"></i>
                                    <h5 class="description-header">Dosen Pembimbing</h5>
                                    <span class="description-text"><?= $dosen->nama_dsn ?></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <div class="col-sm-6">
                                <div class="description-block">
                                    <i class="fa fa-user"></i>
                                    <h5 class="description-header">Dosen Penguji 2</h5>
                                    <?php $peng2 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$data->peng2'")->row(); ?>
                                    <span class="description-text"><?= $peng2->nama ?></span>
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
    <?php } ?>
    <!-- /.content-wrapper -->

</body>

</html>