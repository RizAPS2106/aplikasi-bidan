<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('admin/dashboard'); ?>">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Data
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?= base_url('admin/profil'); ?>">Profil</a></li>
                        <hr>
                        <li><a class="dropdown-item" href="<?= base_url('admin/bidan'); ?>">Data Bidan</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('admin/konsumen'); ?>">Data Konsumen</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <?php if (session()->get('logged_in') == true) : ?>
            <a class="link-light text-decoration-none" href="<?= "/login/logout" ?>">Logout</a>
        <?php else : ?>
            <a class="link-light text-decoration-none" href="<?= "/login" ?>">Login</a>
        <?php endif; ?>
    </div>
</nav>