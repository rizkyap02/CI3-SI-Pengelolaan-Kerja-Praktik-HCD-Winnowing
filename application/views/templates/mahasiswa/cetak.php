<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Cetak</u>
            </h1>

        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#tab_3-2" data-toggle="tab">Dokumen</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_3-2">
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
                                        <?php $cekkp = $this->db->query("select npm as npm from tb_kerjapraktik where npm ='$username'")->num_rows();
                                        ?>
                                        <tr>
                                            <td>Kerangka Acuan</td>
                                            <?php if ($cekkp == 0) { ?>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info" disabled>Unduh</button>
                                                </td>
                                            <?php } else { ?>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo site_url(
                                                                    'mahasiswa/cetak/kerangka_acuan'
                                                                ); ?>" class="btn btn-info" target="_blank">Unduh</a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Lembar Bimbingan</td>
                                            <?php if ($cekkp == 0) { ?>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info" disabled>Unduh</button>
                                                </td>
                                            <?php } else { ?>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo site_url(
                                                                    'mahasiswa/cetak/lembar_bimbingan'
                                                                ); ?>" class="btn btn-info" target="_blank">Unduh</a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Lembar Persetujuan Seminar</td>
                                            <?php if ($cekkp == 0) { ?>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info" disabled>Unduh</button>
                                                </td>
                                            <?php } else { ?>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo site_url(
                                                                    'mahasiswa/cetak/persetujuan_seminar'
                                                                ); ?>" class="btn btn-info" target="_blank">Unduh</a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Bukti Menghadiri Seminar</td>
                                            <?php if ($cekkp == 0) { ?>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info" disabled>Unduh</button>
                                                </td>
                                            <?php } else { ?>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo site_url(
                                                                    'mahasiswa/cetak/bukti_menghadiri_seminar'
                                                                ); ?>" class="btn btn-info" target="_blank">Unduh</a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Lembar Penilaian Pembimbing Lapangan</td>
                                            <?php if ($cekkp == 0) { ?> <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info" disabled>Unduh</button>
                                                </td>
                                            <?php } else { ?>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo site_url(
                                                                    'mahasiswa/cetak/penilaian_pembimbing_lapangan'
                                                                ); ?>" class="btn btn-info" target="_blank">Unduh</a>
                                                </td>
                                            <?php } ?>
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