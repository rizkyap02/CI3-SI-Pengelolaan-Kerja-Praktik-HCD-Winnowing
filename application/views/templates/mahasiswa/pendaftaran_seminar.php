<body class="hold-transition skin-blue sidebar-mini">
    <?php if (strtotime(date('Y/m/d')) >= strtotime(date($jadwal->jd_seminar_s)) && strtotime(date('Y/m/d')) <= strtotime(date($jadwal->jd_seminar_e))) {

        if ($cek >= 1) { ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <u>Pendaftaran Seminar</u>
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box">
                        <?php echo $this->session->flashdata('pesan'); ?>
                        <div class="box-body">
                            <form form method="post" action="<?php echo base_url('mahasiswa/Pendaftaran_seminar/tambah_seminar/' . $data->id_kp) ?>" enctype="multipart/form-data">
                                <!-- text input -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Nama Mahasiswa</label>
                                        <input type="text" class="form-control" value="<?= $nama ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nomor Pokok Mahasiswa</label>
                                        <input type="text" class="form-control" name="npm" value="<?= $username ?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Judul/Topik Kerja Praktik</label>
                                        <input type="text" class="form-control" value="<?= $data->judul ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Lembaga/Perusahaan/Tempat KP</label>
                                        <input type="text" class="form-control" value="<?= $data->nama_lks ?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Dosen Pembimbing</label>
                                        <input type="text" class="form-control" value="<?= $data->nama_dsn ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Transkrip <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="berkas[]" value="" id="exampleInputFile" accept="application/pdf" required oninvalid="this.setCustomValidity('Transkrip wajib dilampirkan !')" oninput="setCustomValidity('')">
                                    </div>
                                    <!-- <div class="form-group col-md-6">
                                        <label>KTM (Kartu Tanda Mahasiswa) <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="berkas[]" value="" id="exampleInputFile" accept="application/pdf" required oninvalid="this.setCustomValidity('KTM wajib dilampirkan !')" oninput="setCustomValidity('')">
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>KRS (Kartu Rencana Studi) yang terdapat mata kuliah KP <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="berkas[]" value="" id="exampleInputFile" accept="application/pdf" required oninvalid="this.setCustomValidity('KRS wajib dilampirkan !')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kerangka Acuan <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="berkas[]" value="" id="exampleInputFile" accept="application/pdf" required oninvalid="this.setCustomValidity('Kerangka acuan wajib dilampirkan !')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Lembar Persetujuan Seminar <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="berkas[]" value="" id="exampleInputFile" accept="application/pdf" required oninvalid="this.setCustomValidity('Lembar persetujuan seminar wajib dilampirkan !')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Bukti Menghadiri Seminar <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="berkas[]" value="" id="exampleInputFile" accept="application/pdf" required oninvalid="this.setCustomValidity('Bukti menghadiri seminar wajib dilampirkan !')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Lembar Bimbingan <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="berkas[]" value="" id="exampleInputFile" accept="application/pdf" required oninvalid="this.setCustomValidity('Lembar bimbingan wajib dilampirkan !')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Lembar Penilaian Pembimbing Lapangan <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="berkas[]" value="" id="exampleInputFile" accept="application/pdf" required oninvalid="this.setCustomValidity('Lembar penilaian pembimbing lapangan wajib dilampirkan !')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>File Laporan KP <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="berkas[]" value="" id="exampleInputFile" accept="application/pdf" required oninvalid="this.setCustomValidity('File laporan KP wajib dilampirkan !')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="terms_and_conditions">Saya menyetujui seluruh syarat dan ketentuan yang berlaku. Seluruh data dan informasi beserta seluruh dokumen yang saya
                                        lampirkan dalam formulir pendaftaran seminar kerja praktik adalah benar dan siap dipertanggung jawabkan.
                                </div>
                                <button type="submit" class="btn btn-info pull-right" id="submit_button" disabled>Kirim</button>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </section>
            <?php } else { ?>
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">

                        <div class="callout callout-danger">
                            <p>Anda belum melakukan pendaftaran kerja praktik. Silahkan melakukan <a href="<?php echo base_url('mahasiswa/Pendaftaran_kp') ?>"> <u>pendaftaran kerja praktik terlebih dahulu !</u></a> ! </p>
                        </div>
                    </section>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">

                    <div class="callout callout-danger">
                        <p>Bukan merupakan periode pendaftaran seminar, silahkan menunggu pendaftaran dibuka oleh Koordinator KP ! </p>
                    </div>
                </section>
            </div>

        <?php } ?>
        <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


</body>

</html>