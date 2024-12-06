<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">

        <span class="brand-text font-weight-light">Admin Buku Tamu</span>
        <h3>
            <b><?= user()->username; ?></b>
        </h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="info">
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('/') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Home
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i> <!-- Ikon utama -->
                        <p>
                            Kunjungan
                            <i class="right fas fa-angle-left"></i> <!-- Ikon dropdown -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('jadwals') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i> <!-- Ikon submenu -->
                                <p>Jadwal Kunjungan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('pengajuans') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Pengajuan Kunjungan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('jadwals/cari') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Detail Data Kunjungan (portal)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('ratings') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rating</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('divisis') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Daftar Divisi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('galeris') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Daftar Galeri(portal)
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                        <p>
                            Berita
                            <i class="right fas fa-angle-left"></i> <!-- Ikon dropdown -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('beritas') ?>" class="nav-link">
                            <i class="nav-icon fas fa-th"></i> <!-- Ikon submenu -->
                                <p>Daftar Berita</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('beritas/halamanberita') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Berita Portal</p>
                            </a>
                        </li>

                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>