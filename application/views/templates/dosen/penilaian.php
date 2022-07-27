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
                            <div class="box-footer">
                                <h4>
                                    <u>Mahasiswa Dibimbing</u>
                                </h4>
                                <table id="example4" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama</th>
                                            <th style="text-align: center;">NPM</th>
                                            <th style="text-align: center;">Judul</th>
                                            <th style="text-align: center;">Dosen Pembimbing</th>
                                            <th style="text-align: center;">Penguji 1</th>
                                            <th style="text-align: center;">Penguji 2</th>
                                            <th style="text-align: center;">Nilai</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kerjapraktik as $kp) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $no++ ?></td>
                                                <td><?php echo $kp->nama_mhs ?></td>
                                                <td><?php echo $kp->npm ?></td>
                                                <td><?php echo $kp->judul ?></td>
                                                <td><?php echo $nama ?></td>
                                                <?php $peng1 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$kp->peng1'")->row();
                                                $peng2 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$kp->peng2'")->row(); ?>
                                                <td><?= $peng1->nama ?></td>
                                                <td><?= $peng2->nama ?></td>
                                                <td style="text-align: center;">
                                                    <?php $cek = $this->db->query("SELECT npm as npm from tb_pembimbing where nip = '$username' AND npm ='$kp->npm'");

                                                    $cekk = $this->db->query("SELECT nilai_pemb as n_pemb FROM tb_nilai JOIN tb_pembimbing ON tb_nilai.npm = tb_pembimbing.npm where nip = '$username' AND tb_pembimbing.npm ='$kp->npm'")->row();
                                                    // $cekkk = $this->db->query("SELECT nilai_peng2 as n_peng2 FROM tb_nilai JOIN tb_penguji ON tb_nilai.npm = tb_penguji.npm where peng2 = '$username' AND tb_penguji.npm ='$kp->npm'")->row();
                                                    if ($cek->num_rows() == 1) {
                                                        if ($cekk == NULL) { ?>

                                                        <?php } else { ?>
                                                            <?= $cekk->n_pemb ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#modal-default1<?= $kp->id_kp ?>" data-title="Ubah">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url("/uploads/$kp->npm/") . $kp->lbr_nilai ?>" class="btn btn-success" data-toggle="tooltip" data-title="Unduh">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                            <?php foreach ($kerjapraktik as $kp) : ?>
                                <div class="modal fade" id="modal-default1<?= $kp->id_kp ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?php echo base_url('dosen/Penilaian/tambah_nilai/' . $kp->npm) ?>" method="post" class="user">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Penilaian Mahasiswa Dibimbing</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Mahasiswa</label>
                                                        <input type="text" class="form-control" value="<?= $kp->nama_mhs ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nomor Pokok Mahasiswa</label>
                                                        <input type="text" class="form-control" name="npm" value="<?= $kp->npm ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Judul</label>
                                                        <input type="text" class="form-control" value="<?= $kp->judul ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nilai</label>
                                                        <?php $cek = $this->db->query("SELECT npm as npm from tb_pembimbing where nip = '$username' AND npm ='$kp->npm'");

                                                        $cekk = $this->db->query("SELECT nilai_pemb as n_pemb FROM tb_nilai JOIN tb_pembimbing ON tb_nilai.npm = tb_pembimbing.npm where nip = '$username' AND tb_pembimbing.npm ='$kp->npm'")->row();
                                                        // $cekkk = $this->db->query("SELECT nilai_peng2 as n_peng2 FROM tb_nilai JOIN tb_penguji ON tb_nilai.npm = tb_penguji.npm where peng2 = '$username' AND tb_penguji.npm ='$kp->npm'")->row();
                                                        if ($cek->num_rows() == 1) {
                                                            if ($cekk == NULL) { ?>
                                                                <input type="number" class="form-control" max="100" name="nilai3" value="0">
                                                            <?php } else { ?>
                                                                <input type="number" class="form-control" max="100" name="nilai3" value="<?= $cekk->n_pemb ?>">
                                                            <?php } ?>
                                                        <?php }  ?>
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
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="box">
                        <div class="box-body">
                            <div class="box-footer">
                                <h4>
                                    <u>Mahasiswa Diuji</u>
                                </h4>
                                <table id="example6" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama</th>
                                            <th style="text-align: center;">NPM</th>
                                            <th style="text-align: center;">Judul</th>
                                            <th style="text-align: center;">Dosen Pembimbing</th>
                                            <th style="text-align: center;">Penguji 1</th>
                                            <th style="text-align: center;">Penguji 2</th>
                                            <th style="text-align: center;">Nilai</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kerjapraktikk as $kp) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $no++ ?></td>
                                                <td><?php echo $kp->nama_mhs ?></td>
                                                <td><?php echo $kp->npm ?></td>
                                                <td><?php echo $kp->judul ?></td>
                                                <?php $pem = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$kp->nip'")->row(); ?>
                                                <td><?php echo $pem->nama ?></td>
                                                <?php $peng1 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$kp->peng1'")->row();
                                                $peng2 = $this->db->query("SELECT nama_dsn as nama from tb_dosen where nip='$kp->peng2'")->row(); ?>
                                                <td><?= $peng1->nama ?></td>
                                                <td><?= $peng2->nama ?></td>
                                                <td style="text-align: center;">
                                                    <?php $cek = $this->db->query("SELECT npm as npm from tb_penguji where peng1 = '$username' AND npm ='$kp->npm'");

                                                    $cekk = $this->db->query("SELECT nilai_peng1 as n_peng1 FROM tb_nilai JOIN tb_penguji ON tb_nilai.npm = tb_penguji.npm where peng1 = '$username' AND tb_penguji.npm ='$kp->npm'")->row();
                                                    $cekkk = $this->db->query("SELECT nilai_peng2 as n_peng2 FROM tb_nilai JOIN tb_penguji ON tb_nilai.npm = tb_penguji.npm where peng2 = '$username' AND tb_penguji.npm ='$kp->npm'")->row();
                                                    if ($cek->num_rows() == 1) {
                                                        if ($cekk == NULL) { ?>

                                                        <?php } else { ?>
                                                            <?= $cekk->n_peng1 ?>
                                                        <?php } ?>
                                                        <?php } else {
                                                        if ($cekkk == NULL) { ?>

                                                        <?php } else { ?>
                                                            <?= $cekkk->n_peng2 ?>
                                                    <?php }
                                                    } ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#modal-default<?= $kp->id_kp ?>" title="Ubah">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url("/uploads/$kp->npm/") . $kp->lbr_nilai ?>" class="btn btn-success" data-toggle="tooltip" data-title="Unduh">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                            <?php foreach ($kerjapraktikk as $kp) : ?>
                                <div class="modal fade" id="modal-default<?= $kp->id_kp ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?php echo base_url('dosen/Penilaian/tambah_nilai/' . $kp->npm) ?>" method="post" class="user">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Penilaian Mahasiswa Diuji</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Mahasiswa</label>
                                                        <input type="text" class="form-control" value="<?= $kp->nama_mhs ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nomor Pokok Mahasiswa</label>
                                                        <input type="text" class="form-control" name="npm" value="<?= $kp->npm ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Judul</label>
                                                        <input type="text" class="form-control" value="<?= $kp->judul ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nilai</label>
                                                        <?php $cek = $this->db->query("SELECT npm as npm from tb_penguji where peng1 = '$username' AND npm ='$kp->npm'");

                                                        $cekk = $this->db->query("SELECT nilai_peng1 as n_peng1 FROM tb_nilai JOIN tb_penguji ON tb_nilai.npm = tb_penguji.npm where peng1 = '$username' AND tb_penguji.npm ='$kp->npm'")->row();
                                                        $cekkk = $this->db->query("SELECT nilai_peng2 as n_peng2 FROM tb_nilai JOIN tb_penguji ON tb_nilai.npm = tb_penguji.npm where peng2 = '$username' AND tb_penguji.npm ='$kp->npm'")->row();
                                                        if ($cek->num_rows() == 1) {
                                                            if ($cekk == NULL) { ?>
                                                                <input type="number" class="form-control" max="100" name="nilai" value="0">
                                                            <?php } else { ?>
                                                                <input type="number" class="form-control" max="100" name="nilai" value="<?= $cekk->n_peng1 ?>">
                                                            <?php } ?>
                                                            <?php } else {
                                                            if ($cekkk == NULL) { ?>
                                                                <input type="number" class="form-control" max="100" name="nilai2" value="0">
                                                            <?php } else { ?>
                                                                <input type="number" class="form-control" max="100" name="nilai2" value="<?= $cekkk->n_peng2 ?>">
                                                        <?php }
                                                        } ?>
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
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>