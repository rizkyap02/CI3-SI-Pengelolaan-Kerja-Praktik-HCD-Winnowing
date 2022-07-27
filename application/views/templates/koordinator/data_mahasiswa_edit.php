<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Ubah Data Mahasiswa</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo base_url('koordinator/Data_mahasiswa/update/') ?>" method="post" class="user">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <input type="hidden" name="id_user" class="form-control" value="<?php echo $mhs->id_user ?>">
                            <input type="text" name="nama" class="form-control" value="<?php echo $mhs->nama_mhs ?>">
                            <?php echo form_error('nama', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>Nomor Pokok Mahasiswa</label>
                            <input type="text" name="npm" class="form-control" value="<?php echo $mhs->username ?>">
                            <?php echo form_error('npm', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $mhs->email_mhs ?>">
                            <?php echo form_error('email', '<div class="text-danger small">') ?>
                        </div>
                        <div class="form-group">
                            <label>Kata Sandi</label>
                            <input type="password" name="password" class="form-control" value="">
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