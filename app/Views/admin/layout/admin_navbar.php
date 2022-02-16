<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('admin/'); ?>">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Data user
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?= base_url('admin/profil'); ?>"><i class="fas fa-user-cog text-success"></i> Profil</a></li>
                        <hr>
                        <li><a class="dropdown-item" href="<?= base_url('admin/owner'); ?>"><i class="fas fa-user-tie text-success"></i> Data Owner</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('admin/konsumen'); ?>"><i class="fas fa-user text-success"></i> Data Konsumen</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('admin/bidan'); ?>"><i class="fas fa-user-md text-success"></i> Data Bidan</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/cabang'); ?>" role="button" aria-expanded="false">
                        Cabang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/layanan'); ?>" role="button" aria-expanded="false">
                        Layanan
                    </a>
                </li>
            </ul>
        </div>
        <?php if (session()->get('logged_in') == true) : ?>
            <a class="link-light text-decoration-none" href="<?= "/login/logout" ?>">Keluar</a>
        <?php else : ?>
            <a class="link-light text-decoration-none" href="<?= "/login" ?>">Masuk</a>
        <?php endif; ?>
    </div>
</nav>