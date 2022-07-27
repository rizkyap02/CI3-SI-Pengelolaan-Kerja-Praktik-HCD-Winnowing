<body class="hold-transition skin-blue sidebar-mini">
    <?php if (strtotime(date('Y/m/d')) >= strtotime(date($jadwal->jd_kp_s)) && strtotime(date('Y/m/d')) <= strtotime(date($jadwal->jd_kp_e))) {
        $npm = $this->session->userdata('username');
        $cekk = $this->db->query("select id_pembimbing as id_pembimbing from tb_pembimbing where npm ='$npm'")->num_rows();
        if ($cekk == 1) { ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <u>Pendaftaran Kerja Praktik</u>
                    </h1>

                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <form form method="post" action="<?php echo base_url('mahasiswa/Pendaftaran_kp/tambah_kp') ?>" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <?php echo $this->session->flashdata('pesan'); ?>
                                <!-- Custom Tabs (Pulled to the right) -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs pull-right">
                                        <li><a href="#tab_1-1" data-toggle="tab">Rencana Kegiatan Kerja Praktik</a></li>
                                        <li class="active"><a href="#tab_3-2" data-toggle="tab">Data Kerja Praktik</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab_1-1">
                                            <div class="control-group after-add-more">
                                                <button class="btn btn-success add-more" type="button">
                                                    <i class="glyphicon glyphicon-plus"></i> Tambah
                                                </button>
                                                <hr>
                                            </div>
                                            <div class="copy hide">
                                                <div class="control-group">
                                                    <div class="form-group">
                                                        <label>Mulai Tanggal</label>
                                                        <input type="date" class="form-control" name="keg_s[]">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Berakhir Tanggal</label>
                                                        <input type="date" class="form-control" name="keg_e[]">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Keterangan Kegiatan</label>
                                                        <input type="text" class="form-control" name="ket[]">
                                                    </div>
                                                    <br>
                                                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="terms_and_conditions">Saya menyetujui seluruh syarat dan ketentuan yang berlaku. Seluruh data dan informasi beserta seluruh dokumen yang saya
                                                    lampirkan dalam formulir pendaftaran kerja praktik adalah benar dan siap dipertanggung jawabkan.
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-info text-right" id="submit_button" disabled>Kirim</button>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane active" id="tab_3-2">
                                            <!-- text input -->
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Nama Mahasiswa</label>
                                                    <input type="text" class="form-control" name="nama_mhs" value="<?= $nama ?>" readonly>
                                                    <?php echo form_error('nama_mhs', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Nomor Pokok Mahasiswa</label>
                                                    <input type="text" class="form-control" name="npm" value="<?= $username ?>" readonly>
                                                    <?php echo form_error('npm', '<div class="text-danger small">') ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Email Mahasiswa</label>
                                                    <input type="text" class="form-control" name="email_mhs" value="<?= $email ?>" readonly>
                                                    <?php echo form_error('email_mhs', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Telepon Mahasiswa <span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" name="telp_mhs">
                                                    <?php echo form_error('telp_mhs', '<div class="text-danger small">') ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Alamat Mahasiswa <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" name="alamat_mhs" maxlength="100">
                                                    <?php echo form_error('alamt_mhs', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Semester/Tahun Akademik <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" name="semester_ta" maxlength="15">
                                                    <?php echo form_error('semester_ta', '<div class="text-danger small">') ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Dosen Pembimbing</label>
                                                    <input type="hidden" class="form-control" name="nip" value="<?= $dosen->nip ?>">
                                                    <input type="text" class="form-control" name="namaaa" value="<?= $dosen->nama_dsn ?>" readonly>
                                                    <?php echo form_error('nip', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Email Dosen Pembimbing</label>
                                                    <input type="text" class="form-control" name="email_dsn" value="<?= $dosen->email_dsn ?>" readonly>
                                                    <?php echo form_error('email_dsn', '<div class="text-danger small">') ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Telepon Dosen Pembimbing</label>
                                                    <input type="number" class="form-control" name="telp_dsn" value="<?= $dosen->telp_dsn ?>" readonly>
                                                    <?php echo form_error('telp_dsn', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Lembaga/Perusahaan/Tempat KP <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" name="nama_lks" maxlength="100">
                                                    <?php echo form_error('nama_lks', '<div class="text-danger small">') ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Fax/Email Lembaga/Perusahaan/Tempat KP <span style="color: red;">*</span></label>
                                                    <input type="email" class="form-control" name="fax_email_lks" maxlength="45">
                                                    <?php echo form_error('fax_email_lks', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Telepon Lembaga/Perusahaan/Tempat KP <span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" name="telp_lks" maxlength="15">
                                                    <?php echo form_error('telp_lks', '<div class="text-danger small">') ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Alamat Lembaga/Perusahaan/Tempat KP <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" name="alamat_lks" maxlength="100">
                                                    <?php echo form_error('alamat_lks', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Nama Pembimbing Lapangan <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" name="nama_pl" maxlength="45">
                                                    <?php echo form_error('nama_pl', '<div class="text-danger small">') ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Judul/Topik Kerja Praktik <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" name="judul" maxlength="250">
                                                    <?php echo form_error('judul', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>TDP/SIUP/Surat Perizinan Kerja Praktik</label>
                                                    <input type="file" class="form-control" name="tdp_siup" id="exampleInputFile" value="<?= set_value('tdp_siup') ?>" accept="application/pdf">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Uraian Singkat <span style="color: red;">*</span></label>
                                                    <textarea class="form-control" name="uraian" rows="3" maxlength="1000"></textarea>
                                                    <?php echo form_error('uraian', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>Perkiraan Jangka Waktu <span style="color: red;">*</span></label>
                                                    <input type="date" class="form-control" name="jangka_waktu_s" placeholder="dd/mm/yyyy">
                                                    <?php echo form_error('jangka_waktu_S', '<div class="text-danger small">') ?>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>&nbsp;</label>
                                                    <h5 style="text-align: center;">s/d</h5>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>&nbsp;</label>
                                                    <input type="date" class="form-control" name="jangka_waktu_e" value="">
                                                    <?php echo form_error('jangka_Waktu_e', '<div class="text-danger small">') ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </form>
                    </div>
                </section>
            <?php } else { ?>
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">

                        <div class="callout callout-danger">
                            <p>Anda belum mendapatkan pembimbing, silahkan menghubungi Koordinator KP ! </p>

                        </div>
                    </section>
                </div>

            <?php } ?>
            <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        <?php } else { ?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">

                    <div class="callout callout-danger">
                        <p>Bukan merupakan periode pendaftaran kerja praktik, silahkan menunggu pendaftaran dibuka oleh Koordinator KP ! </p>
                    </div>
                </section>
            </div>
        <?php } ?>

</body>

</html>