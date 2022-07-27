<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>template/dist/img/user.png" class="img" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Mahasiswa</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Navigasi Utama</li>
            <li class="menu">
                <a href="<?php echo base_url('mahasiswa/Beranda') ?>">
                    <i class="fa fa-home"></i> <span>Beranda</span>
                </a>
            </li>
            <li class="menu">
                <a href="<?php echo base_url('mahasiswa/Daftar_judul') ?>">
                    <i class="fa fa-book"></i> <span>Daftar Judul</span>
                </a>
            </li>
            <li class="menu">
                <a href="<?php echo base_url('mahasiswa/Pendaftaran_kp') ?>">
                    <i class="fa fa-pencil-square-o"></i> <span>Pendaftaran Kerja Praktik</span>
                </a>
            </li>
            <li class="menu">
                <a href="<?php echo base_url('mahasiswa/Pendaftaran_seminar') ?>">
                    <i class="fa fa-pencil-square-o"></i> <span>Pendaftaran Seminar</span>
                </a>
            </li>
            <li class="menu">
                <a href="<?php echo base_url('mahasiswa/Jadwal') ?>">
                    <i class="fa fa-calendar"></i> <span>Jadwal</span>
                </a>
            </li>
            <li class="menu">
                <a href="<?php echo base_url('mahasiswa/Cetak') ?>">
                    <i class="fa fa-print"></i> <span>Cetak</span>
                </a>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>