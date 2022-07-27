<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Profil</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form role="form" method="post" action="<?php echo base_url('dosen/Profil/update') ?>">
                <div class="box">
                    <div class="box-body">
                        <?php echo $this->session->flashdata('pesan'); ?>
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="hidden" name="id_user" class="form-control" value="<?php echo $id_user ?>">
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama ?>" required oninvalid="this.setCustomValidity('Masukan Nama')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="<?php echo $username ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email ?>" required oninvalid="this.setCustomValidity('')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="telp_dsn" class="form-control" value="<?php echo $telp_dsn ?>" required oninvalid="this.setCustomValidity('')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password" maxlength="50" value="">
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