<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Cek Judul</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="<?php echo $data->nama_mhs; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nomor Pokok Mahasiswa</label>
                            <input type="text" class="form-control" value="<?php echo $data->npm; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" value="<?php echo $data->judul; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" value="<?php echo $data->nama_lks; ?>" disabled>
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Uraian Singkat</label>
                            <textarea class="form-control" rows="3" disabled><?php echo $data->uraian; ?></textarea>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example81" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">NPM</th>
                                        <th style="text-align: center;">Judul</th>
                                        <th style="text-align: center;">Lokasi</th>
                                        <th style="text-align: center;">% Judul</th>
                                        <th style="text-align: center;">% Lokasi</th>
                                        <th style="text-align: center;">% Uraian singkat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1; ?>
                                    <?php foreach ($results as $result) : ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $n++; ?></td>
                                            <td><?php echo $result['data']->nama_mhs; ?></td>
                                            <td style="text-align: center;text-transform:uppercase;"><?php echo $result['data']->npm; ?></td>
                                            <td style="text-transform:capitalize;">
                                                <?php echo $result['data']->judul; ?>
                                            </td>
                                            <td>
                                                <?php echo $result['data']->nama_lks; ?>
                                            </td>
                                            <td style="text-align:center;text-transform:capitalize;"><?php echo $result['judul']['data']['jaccard']; ?> %</td>
                                            <td style="text-align:center;text-transform:capitalize;"><?php echo $result['lokasi']['data']['jaccard']; ?> %</td>
                                            <td style="text-align:center;text-transform:capitalize;"><?php echo $result['uraian']['data']['jaccard']; ?> %</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            Total waktu kalkulasi: <?php echo $time; ?> (dalam detik)
                            <br>
                            Penggunaan Memory: {memory_usage}
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