<body class="hold-transition skin-blue sidebar-mini">
    <?php if (strtotime(date('Y/m/d')) >= strtotime(date($jadwal->jd_kp_s)) && strtotime(date('Y/m/d')) <= strtotime(date($jadwal->jd_kp_e))) {
    ?>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->


        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <u>Pembimbing</u>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <?php echo $this->session->flashdata('pesan'); ?>
                            <div class="box-body">
                                <?php $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row(); ?>
                                <?php $cek = $this->db->query("SELECT npm as cek FROM tb_mahasiswa JOIN tb_login ON tb_mahasiswa.id_user = tb_login.id_user JOIN tb_jadwal ON tb_mahasiswa.periode_kp = tb_jadwal.periode_kp where tb_jadwal.periode_kp='$periode->kp' AND tb_login.status = 2")->num_rows(); ?>
                                <?php if ($cek < 2) { ?>
                                    <button type="button" class="btn btn-success" disabled>Acak</button>
                                <?php } else { ?>
                                    <a href="<?php echo base_url('/koordinator/Pembimbing/acak_lagi') ?>" onclick="return confirm('Anda Yakin?');" class="btn btn-success" data-toggle="tooltip" title="Acak Pembimbing">Acak
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="box-footer">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama</th>
                                            <th style="text-align: center;">NPM</th>
                                            <th style="text-align: center;">Dosen Pembimbing</th>
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
                                                <td style="text-align: center;"><?php echo $mhs->npm ?></td>
                                                <td><?php echo $mhs->nama_dsn ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo site_url(); ?>/koordinator/Pembimbing/edit/<?php echo $mhs->npm; ?>" class="btn btn-info" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
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
    <?php } else { ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="callout callout-danger">
                    <p>Sekarang bukan merupakan periode pendaftaran kerja praktik, silahkan memperbaharui jadwal pendaftaran kerja praktik pada menu <a href="<?php echo base_url('koordinator/Jadwal') ?>"> <u>jadwal</u></a> terlebih dahulu !</p>
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
    <?php } ?>
</body>

</html>