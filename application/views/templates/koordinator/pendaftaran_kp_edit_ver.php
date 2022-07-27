<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Ubah Pendaftaran Kerja Praktik</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li><a href="#tab_1-1" data-toggle="tab">Dokumen</a></li>
                            <li class="active"><a href="#tab_3-2" data-toggle="tab">Informasi Kerja Praktik</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="tab_1-1">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td style="text-align: center;">
                                                <b>Nama Dokumen</b>
                                            </td>
                                            <td style="text-align: center;">
                                                <b>File Dokumen</b>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>TDP/SIUP/Surat Perizinan Kerja Praktek</td>
                                            <?php if ($kerjapraktik->tdp_siup == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info">Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url('/uploads/tdp-siup/') . $kerjapraktik->tdp_siup ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="tab_3-2">
                                <form action="<?php echo base_url("koordinator/Pendaftaran_kp/update/$kerjapraktik->npm/$kerjapraktik->id_lks") ?>" method="post" class="user">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label>Lembaga/Perusahaan/Tempat KP</label>
                                                    <input type="text" name="nama_lks" class="form-control" value="<?php echo $kerjapraktik->nama_lks ?>">

                                                </td>
                                                <td>
                                                    <label>Alamat Tempat KP</label>
                                                    <input type="text" name="alamat_lks" class="form-control" value="<?php echo $kerjapraktik->alamat_lks ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Telepon Tempat KP</label>
                                                    <input type="text" name="telp_lks" class="form-control" value="<?php echo $kerjapraktik->telp_lks ?>">
                                                </td>
                                                <td>
                                                    <label>Fax/Email Tempat KP</label>
                                                    <input type="text" name="fax_email_lks" class="form-control" value="<?php echo $kerjapraktik->fax_email_lks ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Dosen Pembimbing</label>
                                                    <input type="text" class="form-control" value="<?php echo $kerjapraktik->nama_dsn ?>" readonly>
                                                </td>
                                                <td>
                                                    <label>Telepon Pembimbing</label>
                                                    <input type="text" class="form-control" value="<?php echo $kerjapraktik->telp_dsn ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Nama Mahasiswa</label>
                                                    <input type="text" class="form-control" value="<?php echo $kerjapraktik->nama_mhs ?>" readonly>
                                                </td>
                                                <td>
                                                    <label>Nomor Pokok Mahasiswa</label>
                                                    <input type="text" class="form-control" value="<?php echo $kerjapraktik->npm ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Semester/Tahun Akademik</label>
                                                    <input type="text" name="semester_ta" class="form-control" value="<?php echo $kerjapraktik->semester_ta ?>">
                                                </td>
                                                <td>
                                                    <label>Alamat Mahasiswa</label>
                                                    <input type="text" name="alamat_mhs" class="form-control" value="<?php echo $kerjapraktik->alamat_mhs ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Telepon Mahasiswa</label>
                                                    <input type="text" name="telp_mhs" class="form-control" value="<?php echo $kerjapraktik->telp_mhs ?>">
                                                </td>
                                                <td>
                                                    <label>Email Mahasiswa</label>
                                                    <input type="text" class="form-control" value="<?php echo $kerjapraktik->email_mhs ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Perkiraan Jangka Waktu</label>
                                                    <input type="date" name="jangka_waktu_s" class="form-control" value="<?php echo $kerjapraktik->jangka_waktu_s ?>">
                                                </td>
                                                <td>
                                                    <label>&nbsp;</label>
                                                    <input type="date" name="jangka_waktu_e" class="form-control" value="<?php echo $kerjapraktik->jangka_waktu_e ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Judul/Topik KP</label>
                                                    <input type="text" name="judul" class="form-control" value="<?php echo $kerjapraktik->judul ?>">
                                                </td>
                                                <td colspan="2">
                                                    <label>Uraian Singkat</label>
                                                    <textarea name="uraian" class="form-control" rows="5"><?php echo $kerjapraktik->uraian ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button type="submit" class="btn btn-info pull-right">Simpan</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                <!-- /.col -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>