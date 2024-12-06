<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('') ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('beritas/halamanberita') ?>" class="nav-link"> Berita</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <?php if (logged_in()): ?>
                <a class="nav-link" href="/logout" role="button" onclick="return confirm('Yakin ingin log out?');">
                    <i class="fas fa-user"></i> Logout
                </a>
            <?php else : ?>
                <a class="nav-link" href="/login" role="button">
                    <i class="fas fa-user"></i> Login
                </a>
            <?php endif; ?>
        </li>


    </ul>
</nav>
<!-- /.navbar -->