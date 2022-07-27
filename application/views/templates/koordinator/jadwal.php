<html>

<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

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
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <?php echo $this->session->flashdata('pesan'); ?>
                        <div class="box-header with-border">
                            <h3 class="box-title">Pendaftaran</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="<?php echo base_url('koordinator/Jadwal/jadwal_df') ?>" method="post" class="user">
                                <!-- text input -->
                                <div class="form-group col-md-12">
                                    <label>Periode Kerja Praktik</label>
                                    <input type="number" min="1" class="form-control" name="periode_kp" value="<?= $jadwal->periode_kp ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mulai Pendaftaran Akun</label>
                                    <input type="date" class="form-control" name="jd_akun_s" value="<?= $jadwal->jd_akun_s ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Berakhir Pendaftaran Akun</label>
                                    <input type="date" class="form-control" name="jd_akun_e" value="<?= $jadwal->jd_akun_e ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mulai Pendaftaran Kerja Praktik</label>
                                    <input type="date" class="form-control" name="jd_kp_s" value="<?= $jadwal->jd_kp_s ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Berakhir Pendaftaran Kerja Praktik</label>
                                    <input type="date" class="form-control" name="jd_kp_e" value="<?= $jadwal->jd_kp_e ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mulai Pendaftaran Seminar Kerja Praktik</label>
                                    <input type="date" class="form-control" name="jd_seminar_s" value="<?= $jadwal->jd_seminar_s ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Berakhir Pendaftaran Seminar Kerja Praktik</label>
                                    <input type="date" class="form-control" name="jd_seminar_e" value="<?= $jadwal->jd_seminar_e ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mulai Seminar Kerja Praktik</label>
                                    <input type="date" class="form-control" name="jd_seminar_m_s" value="<?= $jadwal->jd_seminar_m_s ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Berakhir Seminar Kerja Praktik</label>
                                    <input type="date" class="form-control" name="jd_seminar_m_e" value="<?= $jadwal->jd_seminar_m_e ?>">
                                </div>
                                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <div class="box">
                        <div class="box-body">
                            <?php $periode = $this->db->query("SELECT periode_kp as kp from tb_jadwal")->row(); ?>
                            <?php $cek = $this->db->query("SELECT id_seminar as cek FROM tb_seminar JOIN tb_kerjapraktik ON tb_seminar.id_kp = tb_kerjapraktik.id_kp JOIN tb_mahasiswa ON tb_kerjapraktik.npm = tb_mahasiswa.npm JOIN tb_jadwal ON tb_mahasiswa.periode_kp = tb_jadwal.periode_kp where tb_jadwal.periode_kp='$periode->kp' AND tb_seminar.status_sem = 'Disetujui Koordinator'")->num_rows(); ?>
                            <?php $cekk = $this->db->query("SELECT id_penguji as cekk FROM tb_penguji JOIN tb_mahasiswa ON tb_penguji.npm = tb_mahasiswa.npm JOIN tb_jadwal ON tb_mahasiswa.periode_kp = tb_jadwal.periode_kp where tb_jadwal.periode_kp='$periode->kp'")->num_rows(); ?>
                            <?php if ($cek == null) { ?>
                                <button class="btn btn-success" disabled>Acak</button>
                                <button class="btn btn-warning" disabled>Cetak</button>
                            <?php } elseif ($cekk == null) { ?>
                                <button class="btn btn-success" disabled>Acak</button>
                                <button class="btn btn-warning" disabled>Cetak</button>
                            <?php } else { ?>
                                <a href="<?php echo base_url('/koordinator/Jadwal/acak_jd') ?>" class="btn btn-success" data-toggle="tooltip" title="Acak Jadwal Seminar">Acak
                                </a>
                                <a href="<?php echo base_url('/koordinator/Cetak/jadwal') ?>" class="btn btn-warning" data-toggle="tooltip" title="Cetak Jadwal Seminar">Cetak
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
                                        <th style="text-align: center;">Tanggal Seminar</th>
                                        <th style="text-align: center;">Waktu</th>
                                        <th style="text-align: center;">Lokasi</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($mahasiswa as $mhs) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $no++ ?></td>
                                            <td style="text-transform: capitalize;"><?php echo $mhs->nama_mhs ?></td>
                                            <td style="text-align: center;text-transform:uppercase;"><?php echo $mhs->npm ?></td>
                                            <td style="text-align:center;">
                                                <?php if ($mhs->tgl_seminar == 0000 - 00 - 00) { ?>
                                                    <?= "" ?>
                                                <?php } else { ?>
                                                    <?php $date_s = date_create($mhs->tgl_seminar);
                                                    echo date_format($date_s, 'd/m/Y'); ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php if ($mhs->wkt_seminar == '00:00:00') { ?>
                                                    <?= "" ?>
                                                <?php } else { ?>
                                                    <?php $date_e = date_create($mhs->wkt_seminar);
                                                    echo date_format($date_e, 'H:i'); ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align:center;"><?= $mhs->r_seminar; ?></td>
                                            <td style="text-align: center;">
                                                <a href="<?php echo site_url(); ?>/koordinator/Jadwal/tambah/<?php echo $mhs->npm; ?>" class="btn btn-info" data-toggle="tooltip" title="Ubah"><i class="fa fa-edit"></i></a>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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