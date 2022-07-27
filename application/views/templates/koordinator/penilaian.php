<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Penilaian</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <?php echo $this->session->flashdata('pesan'); ?>
                    <div class="box">
                        <div class="box-body">
                            <a href="<?php echo base_url('/koordinator/Cetak/nilai') ?>" class="btn btn-warning" data-toggle="tooltip" title="Cetak Nilai">Cetak
                            </a>
                        </div>
                        <div class="box-footer">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">NPM</th>
                                        <th style="text-align: center;">Judul</th>
                                        <th style="text-align: center;">Dosen Pembimbing</th>
                                        <th style="text-align: center;">Penguji 1</th>
                                        <th style="text-align: center;">Penguji 2</th>
                                        <th style="text-align: center;">Pembimbing Lapangan</th>
                                        <th style="text-align: center;">Nilai</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($mahasiswa as $mhs) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $no++ ?></td>
                                            <td><?php echo $mhs->nama_mhs ?></td>
                                            <td style="text-align: center;text-transform:uppercase;"><?php echo $mhs->npm ?></td>
                                            <td style="text-transform:capitalize;"><?php echo $mhs->judul ?></td>
                                            <td style="text-transform:capitalize;"><?php echo $mhs->nama_dsn ?></td>
                                            <?php $peng1 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$mhs->peng1'")->row();
                                            $peng2 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$mhs->peng2'")->row(); ?>
                                            <td style="text-transform:capitalize;">
                                                <?php if ($mhs->peng1 == null) { ?>
                                                    - <?php } else { ?>
                                                    <?= $peng1->nama ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-transform:capitalize;">
                                                <?php if ($mhs->peng2 == null) { ?>
                                                    - <?php } else { ?>
                                                    <?= $peng2->nama ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-transform:capitalize;">
                                                <?php if ($mhs->nama_pl == null) { ?>
                                                <?php } else { ?>
                                                    <?php echo $mhs->nama_pl ?>
                                                <?php } ?>
                                            </td>
                                            <?php  ?>
                                            <td style="text-align: center;">
                                                <?php
                                                $total = ($mhs->nilai_pemb * 0.5) + ($mhs->nilai_peng1 * 0.15) + ($mhs->nilai_peng2 * 0.15) + ($mhs->nilai_pl * 0.2);
                                                $cekn = $this->db->query("SELECT keterangan from tb_kerjapraktik where npm = '$mhs->npm'")->row();
                                                if ($mhs->nilai_pemb == 0 || $mhs->nilai_peng1 == 0 || $mhs->nilai_peng2 == 0) {
                                                    echo " ";
                                                } else {
                                                    if ($cekn->keterangan == 'Mengulang') {
                                                        if ($total >= 70) {
                                                            echo "B";
                                                        }
                                                        if ($total >= 65 & $total < 70) {
                                                            echo "B-";
                                                        }
                                                        if ($total >= 60 & $total < 65) {
                                                            echo "C+";
                                                        }
                                                        if ($total >= 55 & $total < 60) {
                                                            echo "C";
                                                        }
                                                        if ($total >= 45 & $total < 55) {
                                                            echo "D";
                                                        }
                                                        if ($total >= 0 & $total < 45) {
                                                            echo "E";
                                                        }
                                                    } else {
                                                        if ($total >= 85 & $total <= 100) {
                                                            echo "A";
                                                        }
                                                        if ($total >= 80 & $total < 85) {
                                                            echo "A-";
                                                        }
                                                        if ($total >= 75 & $total < 80) {
                                                            echo "B+";
                                                        }
                                                        if ($total >= 70 & $total < 75) {
                                                            echo "B";
                                                        }
                                                        if ($total >= 65 & $total < 70) {
                                                            echo "B-";
                                                        }
                                                        if ($total >= 60 & $total < 65) {
                                                            echo "C+";
                                                        }
                                                        if ($total >= 55 & $total < 60) {
                                                            echo "C";
                                                        }
                                                        if ($total >= 45 & $total < 55) {
                                                            echo "D";
                                                        }
                                                        if ($total >= 0 & $total < 45) {
                                                            echo "E";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#modal-default<?= $mhs->id_kp ?>" data-title="Ubah">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                </a>

                                                <a href="<?php echo base_url("/uploads/$mhs->npm/") . $mhs->lbr_nilai ?>" class="btn btn-success" data-toggle="tooltip" data-title="Unduh">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php foreach ($mahasiswa as $mhs) : ?>
                                        <div class="modal fade" id="modal-default<?= $mhs->id_kp ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?php echo base_url('koordinator/Penilaian/tambah_nilai/' . $mhs->npm) ?>" method="post" class="user">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Penilaian Mahasiswa</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama Mahasiswa</label>
                                                                <input type="text" class="form-control" value="<?= $mhs->nama_mhs ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nomor Pokok Mahasiswa</label>
                                                                <input type="text" class="form-control" name="npm" value="<?= $mhs->npm ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Judul</label>
                                                                <input type="text" class="form-control" value="<?= $mhs->judul ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nilai Dosen Pembimbing</label>
                                                                <?php $cek = $this->db->query("SELECT * FROM tb_nilai where npm ='$mhs->npm'")->row();
                                                                if (!$cek) { ?>
                                                                    <input type="number" max="100" class="form-control" name="nilai3" value="0">
                                                                <?php } else { ?>
                                                                    <input type="number" max="100" class="form-control" name="nilai3" value="<?= $cek->nilai_pemb ?>">
                                                                <?php } ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nilai Dosen Penguji 1</label>
                                                                <?php if (!$cek) { ?>
                                                                    <input type="number" max="100" class="form-control" name="nilai" value="0">
                                                                <?php } else { ?>
                                                                    <input type="number" max="100" class="form-control" name="nilai" value="<?= $cek->nilai_peng1 ?>">
                                                                <?php } ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nilai Dosen Penguji 2 </label>
                                                                <?php if (!$cek) { ?>
                                                                    <input type="number" max="100" class="form-control" name="nilai2" value="0">
                                                                <?php } else { ?>
                                                                    <input type="number" max="100" class="form-control" name="nilai2" value="<?= $cek->nilai_peng2 ?>">
                                                                <?php } ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nilai Pembimbing Lapangan </label>
                                                                <?php if (!$cek) { ?>
                                                                    <input type="number" max="100" class="form-control" name="nilai4" value="0">
                                                                <?php } else { ?>
                                                                    <input type="number" max="100" class="form-control" name="nilai4" value="<?= $cek->nilai_pl ?>">
                                                                <?php } ?>
                                                            </div>
                                                            <span style="color: red;">*rentang nilai 0 - 100</span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- </div> -->
                    </div>
                    <!-- /.col -->
                </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>