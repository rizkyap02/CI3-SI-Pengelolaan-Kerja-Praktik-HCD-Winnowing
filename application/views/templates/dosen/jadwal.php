<body class="hold-transition skin-blue sidebar-mini">
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
                        <div class="box-body">
                        </div>
                        <div class="box-footer">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">NPM</th>
                                        <th style="text-align: center;">Dosen Pembimbing</th>
                                        <th style="text-align: center;">Penguji 1</th>
                                        <th style="text-align: center;">Penguji 2</th>
                                        <th style="text-align: center;">Tanggal Seminar</th>
                                        <th style="text-align: center;">Waktu</th>
                                        <th style="text-align: center;">Lokasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($mahasiswa as $mhs) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?= $no++ ?></td>
                                            <td style="text-transform: capitalize;"><?= $mhs->nama_mhs; ?></td>
                                            <td style="text-align: center;text-transform:uppercase;"><?= $mhs->npm; ?></td>
                                            <?php $nip = $this->db->query("SELECT nama_dsn as namaa from tb_dosen where nip='$mhs->nip'")->row(); ?>
                                            <td><?= $nip->namaa ?></td>
                                            <?php $peng1 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$mhs->peng1'")->row();
                                            $peng2 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$mhs->peng2'")->row(); ?>
                                            <td><?= $peng1->nama ?></td>
                                            <td><?= $peng2->nama ?></td>
                                            <td style="text-align:center;">
                                                <?php if ($mhs->tgl_seminar == '0000-00-00') { ?>
                                                    - <?php } else { ?>
                                                    <?php $date_s = date_create($mhs->tgl_seminar);
                                                        echo date_format($date_s, 'd/m/Y'); ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php if ($mhs->wkt_seminar == '00:00:00') { ?>
                                                    - <?php } else { ?>
                                                    <?php $date_e = date_create($mhs->wkt_seminar);
                                                        echo date_format($date_e, 'H:i'); ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php if ($mhs->r_seminar == null) {  ?>
                                                    - <?php } else { ?>
                                                    <?= $mhs->r_seminar; ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
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