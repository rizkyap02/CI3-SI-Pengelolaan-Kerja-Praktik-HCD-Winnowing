<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>template/dist/img/user.png" class="img" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Dosen</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Navigasi Utama</li>
            <li class="menu">
                <a href="<?php echo base_url('dosen/Beranda') ?>">
                    <i class="fa fa-home"></i> <span>Beranda</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-check"></i> <span>Manajamen Persetujuan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('/dosen/Pendaftaran_kp') ?>"><i class="fa fa-circle-o"></i> Pendaftaran Kerja Praktik</a></li>
                    <li><a href="<?php echo base_url('/dosen/Pendaftaran_seminar') ?>"><i class="fa fa-circle-o"></i> Pendaftaran Seminar</a></li>
                </ul>
            </li>
            <li class="menu">
                <a href="<?php echo base_url('/dosen/Jadwal') ?>">
                    <i class="fa fa-calendar"></i> <span>Jadwal</span>
                </a>
            </li>
            <li class="menu">
                <a href="<?php echo base_url('/dosen/Penilaian') ?>">
                    <i class="fa fa-pencil"></i> <span>Manajemen Penilaian</span>
                </a>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>