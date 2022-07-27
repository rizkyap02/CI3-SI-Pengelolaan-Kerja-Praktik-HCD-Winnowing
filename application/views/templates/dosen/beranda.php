<body class="hold-transition skin-blue sidebar-mini">
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
                <div class="col-lg-4 col-xs-4">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <?php $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row(); ?>
                            <h3><?= $this->db->query("SELECT id_kp FROM tb_kerjapraktik JOIN tb_mahasiswa ON tb_mahasiswa.npm = tb_kerjapraktik.npm where nip=$username AND tb_mahasiswa.periode_kp = '$periode->kp' AND tb_kerjapraktik.status != 'Selesai'")->num_rows(); ?></h3>

                            <p>Pendaftaran Kerja Praktik</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-square"></i>
                        </div>
                        <a href="<?php echo base_url('dosen/Pendaftaran_kp') ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-4">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <?php $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row(); ?>
                            <h3><?= $this->db->query("SELECT id_seminar FROM tb_seminar JOIN tb_kerjapraktik ON tb_seminar.id_kp=tb_kerjapraktik.id_kp JOIN tb_mahasiswa ON tb_kerjapraktik.npm = tb_mahasiswa.npm where tb_mahasiswa.periode_kp = '$periode->kp' AND tb_kerjapraktik.nip=$username AND tb_seminar.status_sem != 'Selesai' ")->num_rows(); ?></h3>

                            <p>Pendaftaran Seminar Kerja Praktik</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-square"></i>
                        </div>
                        <a href="<?php echo base_url('dosen/Pendaftaran_seminar') ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-4">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <?php $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row(); ?>
                            <h3><?= $this->db->query("SELECT id_penguji FROM tb_penguji JOIN tb_kerjapraktik ON tb_penguji.npm = tb_kerjapraktik.npm JOIN tb_seminar ON tb_kerjapraktik.id_kp = tb_seminar.id_kp JOIN tb_mahasiswa ON tb_penguji.npm = tb_mahasiswa.npm JOIN tb_pembimbing ON tb_penguji.npm = tb_pembimbing.npm where tb_mahasiswa.periode_kp = '$periode->kp' AND peng1=$username AND tb_seminar.status_sem='Disetujui Koordinator' OR tb_mahasiswa.periode_kp = '$periode->kp' AND peng2=$username AND tb_seminar.status_sem='Disetujui Koordinator' OR tb_mahasiswa.periode_kp = '$periode->kp' AND tb_kerjapraktik.nip=$username AND status_sem = 'Disetujui Koordinator'")->num_rows(); ?></h3>


                            <p>Jadwal Seminar Kerja Praktik</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="<?php echo base_url('dosen/Jadwal') ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <form action="<?php echo base_url('/koordinator/Beranda/input_aksi') ?>" method="post">
                    <div class="col-md-12 col-sm 6">
                        <h3 style="text-align: center;">PENGUMUMAN</h3>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="box">
                            <?php foreach ($pengumuman as $pen) : ?>
                                <div class="box-body">
                                    <?php echo $pen->isi ?>
                                </div>
                            <?php endforeach; ?>
                            <!-- /.box-footer-->
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>