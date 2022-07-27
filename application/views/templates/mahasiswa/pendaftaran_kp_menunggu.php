<body class="hold-transition skin-blue sidebar-mini">
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
                <div class="col-xs-12">
                    <div class="box">
                        <?php echo $this->session->flashdata('pesan'); ?>
                        <div class="box-body" style="text-align: center;">
                            <?php if (strtotime(date('Y/m/d')) >= strtotime(date($jadwal->jd_kp_e))) { ?>
                                <button type="button" class="btn btn-success pull-right" disabled>Pengajuan Perubahan</button>
                            <?php } else { ?>
                                <a href="<?php echo base_url('/mahasiswa/Pendaftaran_kp/perubahan_kp') ?>" onclick="return confirm('Anda yakin ingin mengajukan perubahan ?');" class="btn btn-success pull-right">Pengajuan Perubahan
                                </a>
                            <?php } ?>
                            <h2>Data Pendaftaran Kerja Praktik<h2>
                        </div>
                        <div class="box-footer">
                            <table>
                                <table border="1">
                                    <tr>
                                        <th style="padding:10px;">Lembaga/Perusahaan/Tempat KP</th>
                                        <?php if ($data->nama_lks == null) { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td style="text-transform:capitalize;" class="col-md-10"><?= $data->nama_lks ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Nama Pembimbing Lapangan</th>
                                        <?php if ($data->nama_pl == null) { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td style="text-transform:capitalize;" class="col-md-10"><?= $data->nama_pl ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Alamat Tempat KP</th>
                                        <?php if ($data->alamat_lks == null) { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td style="text-transform:capitalize;" class="col-md-10"><?= $data->alamat_lks ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Telepon Tempat KP</th>
                                        <?php if ($data->telp_lks == null) { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><?= $data->telp_lks ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Fax/Email Tempat KP</th>
                                        <?php if ($data->fax_email_lks == null) { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><?= $data->fax_email_lks ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Nama Mahasiswa</th>
                                        <td style="text-transform:capitalize;" class="col-md-10"><?= $data->nama_mhs ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Nomor Pokok Mahasiswa</th>
                                        <td style="text-transform:uppercase;" class="col-md-10"><?= $data->npm ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Semester/Tahun Akademik</th>
                                        <td style="text-transform:capitalize;" class="col-md-10"><?= $data->semester_ta ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Alamat</th>
                                        <?php if ($data->alamat_mhs == null) { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td style="text-transform:capitalize;" class="col-md-10"><?= $data->alamat_mhs ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Telepon</th>
                                        <?php if ($data->telp_mhs == null) { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><?= $data->telp_mhs ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Email</th>
                                        <td class="col-md-10"><?= $data->email_mhs ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Nama Dosen Pembimbing</th>
                                        <td style="text-transform:capitalize;" class="col-md-10"><?= $data->nama_dsn ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Telepon Dosen Pembimbing</th>
                                        <?php if ($data->telp_dsn == null) { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><?= $data->telp_dsn ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Email Dosen Pembimbing</th>
                                        <td class="col-md-10"><?= $data->email_dsn ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Judul/Topik KP</th>
                                        <td style="text-transform:capitalize;" class="col-md-10"><?= $data->judul ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Uraian singkat KP</th>
                                        <td class="col-md-10"><?= $data->uraian ?></td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">Perkiraan jangka waktu</th>
                                        <td class="col-md-10"><?php $date_s = date_create($data->jangka_waktu_s);
                                                                echo date_format($date_s, 'd-m-Y'); ?> &nbsp;s/d&nbsp; <?php $date_e = date_create($data->jangka_waktu_e);
                                                                                                                        echo date_format($date_e, 'd-m-Y'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding:10px;">TDP/SIUP</th>
                                        <?php if ($data->tdp_siup == '-') { ?>
                                            <td class="col-md-10">-</a></td>
                                        <?php } else { ?>
                                            <td class="col-md-10"><a href="<?php echo base_url("/uploads/tdp-siup/") . $data->tdp_siup ?>"> Lihat </a></td>
                                        <?php } ?>
                                    <tr>
                                        <th style="padding:10px;">Status</th>
                                        <td class="col-md-10"> <?php if ($data->status == "Menunggu") {
                                                                    $label = "label label-warning";
                                                                } elseif ($data->status == "Disetujui Pembimbing") {
                                                                    $label = "label label-success";
                                                                } elseif ($data->status == "Disetujui Koordinator") {
                                                                    $label = "label label-info";
                                                                } elseif ($data->status == "Perubahan Judul") {
                                                                    $label = "label label-primary";
                                                                } else {
                                                                    $label = "label label-danger";
                                                                }
                                                                ?>
                                            <span class="<?= $label ?>"><?php echo $data->status ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </table>
                        </div>
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h2 class="box-title">Rencana Kegiatan Kerja Praktik</h2>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
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
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>