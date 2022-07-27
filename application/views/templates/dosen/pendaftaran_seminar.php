<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Pendaftaran Seminar</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-footer">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">NPM</th>
                                        <th style="text-align: center;">Judul</th>
                                        <th style="text-align: center;">Lokasi</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kerjapraktik as $kp) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $no++ ?></td>
                                            <td><?php echo $kp->nama_mhs ?></td>
                                            <td style="text-align: center;"><?php echo $kp->npm ?></td>
                                            <td><?php echo $kp->judul ?></td>
                                            <td><?php echo $kp->nama_lks ?></td>
                                            <td style="text-align: center;"> <?php if ($kp->status_sem == "Menunggu") {
                                                                                    $label = "label label-warning";
                                                                                } elseif ($kp->status_sem == "Disetujui") {
                                                                                    $label = "label label-success";
                                                                                } else {
                                                                                    $label = "label label-danger";
                                                                                }
                                                                                ?>
                                                <span class="<?= $label ?>"><?php echo $kp->status_sem ?></span>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="<?php echo base_url('/dosen/Pendaftaran_seminar/info/') . $kp->id_kp ?>" class="btn btn-default" data-toggle="tooltip" title="Detil Informasi">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>