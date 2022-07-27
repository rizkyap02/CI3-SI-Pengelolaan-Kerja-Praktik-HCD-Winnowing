<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Beranda</u>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="callout callout-info">
                <p>Selamat datang pada halaman Sistem Informasi Kerja Praktik. Silahkan melakukan <a href="<?php echo base_url('mahasiswa/Pendaftaran_kp') ?>"> <u>pendaftaran</u></a> ! </p>
            </div>
            <div class="row">
                <form action="<?php echo base_url('/koordinator/Beranda/input_aksi') ?>" method="post">
                    <div class="col-md-12 col-sm 6">
                        <h3 style="text-align: center;">PENGUMUMAN</h3>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="box">
                            <?php foreach ($pengumuman as $pen) : ?>
                                <div class="box-body">
                                    <?php echo $pen->isi ?>
                                </div>
                            <?php endforeach; ?>
                            <!-- /.box-footer-->
                        </div>
                    </div>
                </form>
                <div class="row">
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>