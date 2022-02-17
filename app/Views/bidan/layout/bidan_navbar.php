<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('bidan/'); ?>">Bidan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/cabang'); ?>" role="button" aria-expanded="false">
                        Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/cabang'); ?>" role="button" aria-expanded="false">
                        Riwayat Pesanan
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