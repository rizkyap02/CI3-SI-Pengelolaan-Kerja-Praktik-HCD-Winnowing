<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Detil Informasi</u>
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
                            <li><a href="#tab_2-1" data-toggle="tab">Rencana Kegiatan</a></li>
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
                                            <?php if ($kerjapraktik->tdp_siup == '-') { ?> <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url('/uploads/tdp-siup/') . $kerjapraktik->tdp_siup ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_2-1">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Mulai</th>
                                            <th style="text-align: center;">Berakhir</th>
                                            <th style="text-align: center;">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($keg as $keg) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $no++ ?></td>
                                                <td style="text-align: center;"><?php $date_st = date_create($keg->keg_s);
                                                                                echo date_format($date_st, 'd-m-Y'); ?></td>
                                                <td style="text-align: center;"><?php $date_en = date_create($keg->keg_e);
                                                                                echo date_format($date_en, 'd-m-Y'); ?></td>
                                                <td><?php echo $keg->ket ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="tab_3-2">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label>Lembaga/Perusahaan/Tempat KP</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->nama_lks ?>" readonly>

                                            </td>
                                            <td>
                                                <label>Alamat Tempat KP</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->alamat_lks ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Telepon Tempat KP</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->telp_lks ?>" readonly>
                                            </td>
                                            <td>
                                                <label>Fax/Email Tempat KP</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->fax_email_lks ?>" readonly>
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
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->semester_ta ?>" readonly>
                                            </td>
                                            <td>
                                                <label>Alamat Mahasiswa</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->alamat_mhs ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Telepon Mahasiswa</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->telp_mhs ?>" readonly>
                                            </td>
                                            <td>
                                                <label>Email Mahasiswa</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->email_mhs ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Perkiraan Jangka Waktu</label>
                                                <input type="text" class="form-control" value="<?php $date_s = date_create($kerjapraktik->jangka_waktu_s);
                                                                                                echo date_format($date_s, 'd-m-Y'); ?>" readonly>
                                            </td>
                                            <td>
                                                <label>&nbsp;</label>
                                                <input type="text" class="form-control" value="<?php $date_e = date_create($kerjapraktik->jangka_waktu_e);
                                                                                                echo date_format($date_e, 'd-m-Y'); ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Judul/Topik KP</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->judul ?>" readonly>
                                            </td>
                                            <td colspan="2">
                                                <label>Uraian Singkat</label>
                                                <textarea class="form-control" rows="5" readonly><?php echo $kerjapraktik->uraian ?></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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