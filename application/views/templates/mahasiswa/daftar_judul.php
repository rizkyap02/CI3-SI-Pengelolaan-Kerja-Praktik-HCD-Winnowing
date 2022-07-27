<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Daftar Judul</u>
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
                                        <th style="text-align: center;">Judul</th>
                                        <th style="text-align: center;">Lokasi</th>
                                        <th style="text-align: center;">Semester/Tahun Akademik</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kerjapraktik as $kp) : ?>
                                        <tr>
                                            <td style="text-align: center; text-transform:capitalize;"><?php echo $no++ ?></td>
                                            <td style="text-transform:capitalize;"><?php echo $kp->nama_mhs ?></td>
                                            <td style="text-align: center; text-transform:uppercase;"><?php echo $kp->npm ?></td>
                                            <td style="text-transform:capitalize;"><?php echo $kp->judul ?></td>
                                            <td style="text-transform:capitalize;"><?php echo $kp->nama_lks ?></td>
                                            <td style="text-align: center; text-transform:capitalize;"><?php echo $kp->semester_ta ?></td>
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