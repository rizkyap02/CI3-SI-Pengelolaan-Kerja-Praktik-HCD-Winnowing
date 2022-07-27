<body class="hold-transition skin-blue sidebar-mini">

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Beranda</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">

                            <?php $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row(); ?>
                            <h3><?= $this->db->query("SELECT id_kp FROM tb_kerjapraktik JOIN tb_mahasiswa ON tb_mahasiswa.npm = tb_kerjapraktik.npm where tb_mahasiswa.periode_kp = '$periode->kp' AND tb_kerjapraktik.status = 'Disetujui Koordinator' OR tb_kerjapraktik.status = 'Disetujui Pembimbing' OR tb_kerjapraktik.status = 'Ditolak'")->num_rows(); ?></h3>

                            <p>Pendaftaran Kerja Praktik</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-square"></i>
                        </div>
                        <a href="<?php echo base_url('koordinator/Pendaftaran_kp') ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <?php $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row(); ?>
                            <h3><?= $this->db->query("SELECT id_seminar FROM tb_seminar JOIN tb_kerjapraktik ON tb_seminar.id_kp = tb_kerjapraktik.id_kp JOIN tb_mahasiswa ON tb_kerjapraktik.npm = tb_mahasiswa.npm where tb_mahasiswa.periode_kp = '$periode->kp' AND tb_seminar.status_sem = 'Disetujui' OR tb_seminar.status_sem = 'Ditolak'")->num_rows(); ?></h3>

                            <p>Pendaftaran Seminar Kerja Praktik</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-square"></i>
                        </div>
                        <a href="<?php echo base_url('koordinator/Pendaftaran_seminar') ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <form>
                    <div class="col-md-12 col-sm 6">
                        <h3 style="text-align: center;">PENGUMUMAN</h3>
                    </div>
                </form>
            </div>
            <div class="box">
                <?php echo $this->session->flashdata('pesan'); ?>
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <?php foreach ($pengumuman as $pen) : ?>
                        <form method="post" action="<?php echo base_url('koordinator/beranda/tambah') ?>">
                            <textarea class="textarea" placeholder="Masukkan pengumuman disini..." name="isi" style=" width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $pen->isi ?></textarea>
                            <button type="submit" class="btn btn-info pull-right">Simpan</button>
                            <button type="reset" class="btn btn-warning pull-right">Atur Ulang</button>
                        </form>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>