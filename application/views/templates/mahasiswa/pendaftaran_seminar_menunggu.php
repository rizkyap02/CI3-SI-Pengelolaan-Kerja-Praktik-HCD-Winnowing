<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Pendaftaran Seminar Kerja Praktik</u>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <?php echo $this->session->flashdata('pesan'); ?>
                        <div class="box-body" style="text-align: center;">
                            <h2>
                                Data Pendaftaran Seminar Kerja Praktik<h2>
                        </div>
                        <div class="box-footer">
                            <table>
                                <table border="1">
                                    <tr>
                                        <th style="padding:10px;">Nama Mahasiswa</th>
                                        <td style="text-transform:capitalize;" class="col-md-10"><?= $data->nama_mhs ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Nomor Pokok Mahasiswa</th>
                                        <td style="text-transform:uppercase;" class="col-md-10"><?= $data->npm ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Judul/Topik KP</th>
                                        <td style="text-transform:capitalize;" class="col-md-10"><?= $data->judul ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Lembaga/Perusahaan/Tempat KP</th>
                                        <td style="text-transform:capitalize;" class="col-md-10"><?= $data->nama_lks ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Dosen Pembimbing</th>
                                        <td style="text-transform:capitalize;" class="col-md-10"><?= $data->nama_dsn ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <th style="padding:10px;">KTM (Kartu Tanda Mahasiswa)</th>
                                        <?php if ($data->ktm == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/$data->npm/") . $data->ktm ?>"> Lihat </a></td>
                                        <?php } ?>
                                    </tr> -->
                                    <tr>
                                        <th style="padding:10px;">Transkrip</th>
                                        <?php if ($data->transkrip == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/$data->npm/") . $data->transkrip ?>"> Lihat </a></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">KRS (Kartu Rencana Studi)</th>
                                        <?php if ($data->krs == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/$data->npm/") . $data->krs ?>"> Lihat </a></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Kerangka Acuan</th>
                                        <?php if ($data->kerangka_acuan == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/$data->npm/") . $data->kerangka_acuan ?>"> Lihat </a></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Lembar Persetujuan Seminar</th>
                                        <?php if ($data->lbr_persetujuan == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/$data->npm/") . $data->lbr_persetujuan ?>"> Lihat </a></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Bukti Menghadiri Seminar</th>
                                        <?php if ($data->bukti_hadir == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/$data->npm/") . $data->bukti_hadir ?>"> Lihat </a></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Lembar Bimbingan</th>
                                        <?php if ($data->lbr_bimbingan == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/$data->npm/") . $data->lbr_bimbingan ?>"> Lihat </a></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Lembar Penilaian Pembimbing Lapangan</th>
                                        <?php if ($data->lbr_nilai == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/$data->npm/") . $data->lbr_nilai ?>"> Lihat </a></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">File Laporan KP</th>
                                        <?php if ($data->lap_kp == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/$data->npm/") . $data->lap_kp ?>"> Lihat </a></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Status</th>
                                        <td class="col-md-10"> <?php if ($data->status_sem == "Menunggu") {
                                                                    $label = "label label-warning";
                                                                } elseif ($data->status_sem == "Disetujui") {
                                                                    $label = "label label-success";
                                                                } elseif ($data->status_sem == "Selesai") {
                                                                    $label = "label label-info";
                                                                } else {
                                                                    $label = "label label-danger";
                                                                }
                                                                ?>
                                            <span class="<?= $label ?>"><?php echo $data->status_sem ?></span>
                                        </td>
                                    </tr>
                                </table>
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

</body>

</html>