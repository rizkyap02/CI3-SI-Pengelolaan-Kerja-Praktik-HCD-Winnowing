<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Data Seminar Kerja Praktik</u>
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
                                        <th style="text-align: center;">Dosen Pembimbing</th>
                                        <th style="text-align: center;">Penguji 1</th>
                                        <th style="text-align: center;">Penguji 2</th>
                                        <th style="text-align: center;">Tanggal Seminar</th>
                                        <th style="text-align: center;">Waktu Seminar</th>
                                        <th style="text-align: center;">Lokasi Seminar</th>
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
                                            <td><?php echo $kp->nama_dsn ?></td>
                                            <td>
                                                <?php $peng1 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$kp->peng1'")->row(); ?>
                                                <?php echo $peng1->nama ?>
                                            </td>
                                            <td>
                                                <?php $peng2 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$kp->peng2'")->row(); ?>
                                                <?php echo $peng2->nama ?>
                                            </td>
                                            <td style="text-align:center;"><?php $date_s = date_create($kp->tgl_seminar);
                                                                            echo date_format($date_s, 'd/m/Y'); ?></td>
                                            <td style="text-align:center;"><?php $date_e = date_create($kp->wkt_seminar);
                                                                            echo date_format($date_e, 'H:i'); ?></td>
                                            <td style="text-align: center;"><?= $kp->r_seminar ?></td>
                                            <td style="text-align: center;">
                                                <a href="<?php echo base_url('/koordinator/Data_seminar/info/') . $kp->id_kp ?>" class="btn btn-default" data-toggle="tooltip" title="Detil informasi">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                                <a href="<?php echo base_url('/koordinator/Data_seminar/hapus/') . $kp->id_kp ?>" class="btn btn-danger" data-toggle="tooltip" title="Hapus">
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