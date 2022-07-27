<body class="hold-transition skin-blue sidebar-mini">
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
                                            <td>Kerangka Acuan</td>
                                            <?php if ($kerjapraktik->kerangka_acuan == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url("/uploads/$kerjapraktik->npm/") . $kerjapraktik->kerangka_acuan ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                        <!-- <tr>
                                            <td>KTM (Karu Tanda Mahasiswa)</td>
                                            <?php if ($kerjapraktik->ktm == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url("/uploads/$kerjapraktik->npm/") . $kerjapraktik->ktm ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr> -->
                                        <tr>
                                            <td>Transkrip</td>
                                            <?php if ($kerjapraktik->transkrip == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url("/uploads/$kerjapraktik->npm/") . $kerjapraktik->transkrip ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>KRS (Kartu Rencana Studi) yang terdapat mata kuliah KP</td>
                                            <?php if ($kerjapraktik->krs == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url("/uploads/$kerjapraktik->npm/") . $kerjapraktik->krs ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Lembar Persetujuan Seminar </td>
                                            <?php if ($kerjapraktik->lbr_persetujuan == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url("/uploads/$kerjapraktik->npm/") . $kerjapraktik->lbr_persetujuan ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Bukti Menghadiri Seminar</td>
                                            <?php if ($kerjapraktik->bukti_hadir == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url("/uploads/$kerjapraktik->npm/") . $kerjapraktik->bukti_hadir ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Lembar Bimbingan</td>
                                            <?php if ($kerjapraktik->lbr_bimbingan == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url("/uploads/$kerjapraktik->npm/") . $kerjapraktik->lbr_bimbingan ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Lembar Penilaian Pembimbing Lapangan</td>
                                            <?php if ($kerjapraktik->lbr_nilai == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url("/uploads/$kerjapraktik->npm/") . $kerjapraktik->lbr_nilai ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>File Laporan KP</td>
                                            <?php if ($kerjapraktik->lap_kp == '-') { ?>
                                                <td style="text-align: center;"><button type="button" class="btn btn-info" disabled>Unduh</button></td>
                                            <?php } else { ?>
                                                <td style="text-align: center;"><a href="<?php echo base_url("/uploads/$kerjapraktik->npm/") . $kerjapraktik->lap_kp ?>" class="btn btn-info">Unduh</a></td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="tab_3-2">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label>Nama</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->nama_mhs ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Nomor Pokok Mahasiswa</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->npm ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Judul</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->judul ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Lembaga/Perusahaan/Tempat KP</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->nama_lks ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Nama Dosen Pembimbing</label>
                                                <input type="text" class="form-control" value="<?php echo $kerjapraktik->nama_dsn ?>" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>