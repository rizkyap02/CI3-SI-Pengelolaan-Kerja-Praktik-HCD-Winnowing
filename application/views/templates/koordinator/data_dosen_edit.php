<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Ubah Data Dosen</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo base_url('koordinator/Data_dosen/update/') ?>" method="post" class="user">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="hidden" name="id_user" class="form-control" value="<?php echo $dsn->id_user ?>">
                            <input type="text" name="nama" class="form-control" value="<?php echo $dsn->nama_dsn ?>">
                            <?php echo form_error('nama', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="<?php echo $dsn->username ?>">
                            <?php echo form_error('nip', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $dsn->email_dsn ?>">
                            <?php echo form_error('email', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="telp_dsn" class="form-control" value="<?php echo $dsn->telp_dsn ?>">
                            <?php echo form_error('telp_dsn', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>Kata Sandi</label>
                            <input type="password" name="password" class="form-control">
                            <?php echo form_error('password_1', '<div class="text-danger small">') ?>
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