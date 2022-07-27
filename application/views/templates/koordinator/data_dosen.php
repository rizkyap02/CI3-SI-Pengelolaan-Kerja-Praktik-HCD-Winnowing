<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Data Dosen</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <?php echo $this->session->flashdata('pesan'); ?>
                        <div class="box-body">
                            <a href="<?php echo base_url('/koordinator/Data_dosen/tambah') ?>" class="btn btn-info" data-toggle="tooltip" title="Tambah Data Dosen">Tambah
                            </a>
                        </div>
                        <div class="box-footer">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">NIP</th>
                                        <th style="text-align: center;">Email</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($dosen as $dsn) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $no++ ?></td>
                                            <td><?php echo $dsn->nama_dsn ?></td>
                                            <td style="text-align: center;"><?php echo $dsn->username ?></td>
                                            <td><?php echo $dsn->email_dsn ?></td>
                                            <td style="text-align: center;">
                                                <a href="<?php echo site_url(); ?>koordinator/Data_dosen/edit/<?php echo $dsn->id_user; ?>" class="btn btn-info" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
                                                <a href="<?php echo site_url(); ?>koordinator/Data_dosen/hapus/<?php echo $dsn->id_user; ?>" onclick="return confirm('Anda Yakin?');" class="btn btn-danger" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
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