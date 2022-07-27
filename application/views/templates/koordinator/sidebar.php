<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>template/dist/img/user.png" class="img" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Koordinator</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Navigasi Utama</li>
            <li class="menu">
                <a href="<?php echo base_url('koordinator/Beranda') ?>">
                    <i class="fa fa-home"></i> <span>Beranda</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-check"></i> <span>Verifikasi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('/koordinator/Akun_mhs') ?>"><i class="fa fa-circle-o"></i> Akun Mahasiswa</a></li>
                    <li><a href="<?php echo base_url('/koordinator/Pendaftaran_kp') ?>"><i class="fa fa-circle-o"></i> Pendaftaran Kerja Praktik</a></li>
                    <li><a href="<?php echo base_url('/koordinator/Pendaftaran_seminar') ?>"><i class="fa fa-circle-o"></i> Pendaftaran Seminar</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Manajemen Kerja Praktik</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('/koordinator/Pembimbing') ?>"><i class="fa fa-circle-o"></i> Pembimbing</a></li>
                    <li><a href="<?php echo base_url('/koordinator/Penguji') ?>"><i class="fa fa-circle-o"></i> Penguji</a></li>
                    <li><a href="<?php echo base_url('/koordinator/Jadwal') ?>"><i class="fa fa-circle-o"></i> Jadwal</a></li>
                    <li><a href="<?php echo base_url('/koordinator/Penilaian') ?>"><i class="fa fa-circle-o"></i> Penilaian</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Data Utama</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('/koordinator/Data_dosen') ?>"><i class="fa fa-circle-o"></i> Data Dosen</a></li>
                    <li><a href="<?php echo base_url('/koordinator/Data_mahasiswa') ?>"><i class="fa fa-circle-o"></i> Data Mahasiswa</a></li>
                    <li><a href="<?php echo base_url('/koordinator/Data_kerjapraktik') ?>"><i class="fa fa-circle-o"></i> Data Kerja Praktik</a></li>
                    <li><a href="<?php echo base_url('/koordinator/Data_seminar') ?>"><i class="fa fa-circle-o"></i> Data Seminar Kerja Praktik</a></li>
                </ul>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>