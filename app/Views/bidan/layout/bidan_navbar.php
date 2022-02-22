<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('bidan/'); ?>">Bidan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('bidan/profil'); ?>" role="button" aria-expanded="false">
                        Profil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button" aria-expanded="false">
                        Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button" aria-expanded="false">
                        Riwayat Pesanan
                    </a>
                </li>
            </ul>
        </div>
        <?php if (session()->get('logged_in') == true) : ?>
            <button class="btn btn-success" id="logout">Keluar</button>
        <?php else : ?>
            <button class="btn btn-success" id="logout">
                <a class="text-decoration-none" href="<?= "/login" ?>">Masuk</a>
            </button>
        <?php endif; ?>
    </div>
</nav>