<body class="hold-transition skin-blue sidebar-mini">


    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->


    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <u>Ubah Jadwal Seminar</u>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo base_url("koordinator/Jadwal/update/$mahasiswa->id_kp") ?>" method="post" class="user">
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <input type="text" class="form-control" value="<?php echo $mahasiswa->nama_mhs ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nomor Pokok Mahasiswa</label>
                            <input type="text" class="form-control" value="<?php echo $mahasiswa->npm ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Seminar</label>
                            <input type="date" class="form-control" name="tgl_seminar" placeholder="dd/mm/yyyy" value="<?php echo $mahasiswa->tgl_seminar ?>">
                        </div>
                        <div class="form-group">
                            <label>Waktu</label>
                            <input type="time" class="form-control" id="appt" name="wkt_seminar" value="<?php echo $mahasiswa->wkt_seminar ?>">
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" name="r_seminar" value="<?php echo $mahasiswa->r_seminar ?>">
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