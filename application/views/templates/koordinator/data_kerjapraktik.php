<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Data Kerja Praktik</u>
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
                                        <th style="text-align: center;">Lokasi</th>
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
                                            <td><?php echo $kp->nama_lks ?></td>
                                            <td style="text-align: center;">
                                                <a href="<?php echo base_url('/koordinator/Data_kerjapraktik/edit/' . $kp->npm) ?>" class="btn btn-info" data-toggle="tooltip" title="Ubah">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="<?php echo base_url('/koordinator/Data_kerjapraktik/hapus/' . $kp->npm) ?>" onclick="return confirm('Anda Yakin?');" class="btn btn-danger" data-toggle="tooltip" title="Hapus">
                                                    <i class="fa fa-trash"></i>
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
                </div>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>