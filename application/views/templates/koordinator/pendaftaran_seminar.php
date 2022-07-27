<body class="hold-transition skin-blue sidebar-mini">
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
                        <?php echo $this->session->flashdata('pesan'); ?>
                        <div class="box-footer">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">NPM</th>
                                        <th style="text-align: center;">Judul</th>
                                        <th style="text-align: center;">Dosen Pembimbing</th>
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
                                            <td><?php echo $kp->npm ?></td>
                                            <td><?php echo $kp->judul ?></td>
                                            <td><?php echo $kp->nama_dsn ?></td>
                                            <td style="text-align: center;"> <?php if ($kp->status_sem == "Menunggu") {
                                                                                    $label = "label label-warning";
                                                                                } elseif ($kp->status_sem == "Disetujui") {
                                                                                    $label = "label label-success";
                                                                                } elseif ($kp->status_sem == "Selesai") {
                                                                                    $label = "label label-info";
                                                                                } else {
                                                                                    $label = "label label-danger";
                                                                                }
                                                                                ?>
                                                <span class="<?= $label ?>"><?php echo $kp->status_sem ?></span>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="<?php echo base_url('/koordinator/Pendaftaran_seminar/info/' . $kp->npm) ?>" class="btn btn-default" data-toggle="tooltip" title="Detil Informasi">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                                <?php if ($kp->status_sem == "Ditolak") { ?>
                                                    <a href="<?php echo base_url('/koordinator/Pendaftaran_seminar/status_acc/') . $kp->id_kp ?>" class="btn btn-success" data-toggle="tooltip" title="Setujui">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                <?php } elseif ($kp->status_sem == "Menunggu") { ?>
                                                    <a href="<?php echo base_url('/koordinator/Pendaftaran_seminar/status_acc/') . $kp->id_kp ?>" class="btn btn-success" data-toggle="tooltip" title="Setujui">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                <?php } elseif ($kp->status_sem == "Disetujui") { ?>
                                                    <a href="<?php echo base_url('/koordinator/Pendaftaran_seminar/status_dc/') . $kp->id_kp ?>" class="btn btn-danger" data-toggle="tooltip" title="Tolak">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="<?php echo base_url('/koordinator/Pendaftaran_seminar/status_dc/') . $kp->id_kp ?>" class="btn btn-danger" data-toggle="tooltip" title="Tolak">
                                                        <i class="fa fa-close"></i>
                                                    <?php  } ?>
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