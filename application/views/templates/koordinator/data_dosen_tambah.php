<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Tambah Data Dosen</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php echo $this->session->flashdata('pesan'); ?>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo base_url('koordinator/data_dosen/tambah') ?>" class="user">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="text" class="form-control" name="nama" value="<?= set_value('nama') ?>">
                            <?php echo form_error('nama', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control" name="nip" value="<?= set_value('nip') ?>">
                            <?php echo form_error('nip', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?= set_value('email') ?>">
                            <?php echo form_error('email', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" class="form-control" name="telp_dsn" value="<?= set_value('telp_dsn') ?>">
                            <?php echo form_error('telp_dsn', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>Kata Sandi</label>
                            <input type="password" class="form-control" name="password_1">
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