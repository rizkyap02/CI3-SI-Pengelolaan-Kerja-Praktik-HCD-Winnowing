<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Ubah Penguji</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                <form action="<?php echo base_url("koordinator/Penguji/update/$mahasiswa->npm") ?>" method="post" class="user">   
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <input type="text" class="form-control" value="<?php echo $mahasiswa->nama_mhs ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nomor Pokok Mahasiswa</label>
                            <input type="text" class="form-control" value="<?php echo $mahasiswa->npm ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" value="<?php echo $mahasiswa->judul ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Penguji 1</label>
                            <select class="form-control" name="peng1">
                            <?php $data=$this->db->query("select nama_dsn,nip from tb_dosen where nip NOT IN($mahasiswa->peng1)")->result(); 
                                $peng1 = $this->db->query("select nama_dsn,nip from tb_dosen where nip = '$mahasiswa->peng1'")->row();?>
                            <option value="<?php echo $peng1->nip ?>"><?php echo $peng1->nama_dsn ?></option>
                            <?php foreach($data as $dosen){?>                
                                <option value="<?php echo $dosen->nip ?>"><?php echo $dosen->nama_dsn ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penguji 2</label>
                            <select class="form-control" name="peng2">
                            <?php $data=$this->db->query("select nama_dsn,nip from tb_dosen where nip NOT IN($mahasiswa->peng2)")->result(); 
                                  $peng2 = $this->db->query("select nama_dsn,nip from tb_dosen where nip = '$mahasiswa->peng2'")->row();?>
                            <option value="<?php echo $peng2->nip ?>"><?php echo $peng2->nama_dsn ?></option>
                            <?php foreach($data as $dosen){?>                
                                <option value="<?php echo $dosen->nip ?>"><?php echo $dosen->nama_dsn ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info pull-right">Simpan</button>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>