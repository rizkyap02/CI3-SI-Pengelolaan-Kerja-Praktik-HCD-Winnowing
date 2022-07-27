<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Tambah Data Mahasiswa</u>
            </h1>
        </section>

        <section class="content">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo base_url('koordinator/data_mahasiswa/tambah') ?>" class="user">
                        <!-- text input -->
                        <div class="form-group has-feedback">
                            <label>Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="nama" value="<?= set_value('nama') ?>">
                            <?php echo form_error('nama', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Nomor Pokok Mahasiswa</label>
                            <input type="text" class="form-control" name="npm" value="<?= set_value('npm') ?>">
                            <?php echo form_error('npm', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?= set_value('email') ?>">
                            <?php echo form_error('email', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Kata Sandi</label>
                            <input type="password" class="form-control" name="password_1">
                            <?php echo form_error('password_1', '<div class="text-danger small">') ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user pull-right">Tambah</button>
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