<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Akun Mahasiswa</u>
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
                                        <th style="text-align: center;">Email</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($mahasiswa as $mhs) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $no++ ?></td>
                                            <td><?php echo $mhs->nama_mhs ?></td>
                                            <td style="text-align: center;"><?php echo $mhs->username ?></td>
                                            <td><?php echo $mhs->email_mhs ?></td>
                                            <td style="text-align: center;"><span class="label <?php if ($mhs->status == "2") { ?> label-info <?php } elseif ($mhs->status == "1") { ?>
                                            label-danger ?> <?php } else {  ?> label-secondary <?php } ?>"><?php echo $mhs->status == 1 ? "Tidak Aktif" : "Aktif" ?></span></td>
                                            <td style="text-align: center;">
                                                <?php if ($mhs->status == "1") { ?>
                                                    <a href="<?php echo site_url(); ?>koordinator/Akun_mhs/status_acc/<?php echo $mhs->id_user; ?>" onclick="return confirm('Anda Yakin?');" class="btn btn-sm btn-success" data-toggle="tooltip" title="Setujui"><i class="fa fa-check"></i></a>
                                                <?php } else { ?>
                                                    <a href="<?php echo site_url(); ?>koordinator/Akun_mhs/status_dc/<?php echo $mhs->id_user; ?>" onclick="return confirm('Anda Yakin?');" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Tolak"><i class="fa fa-close"></i></a>
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