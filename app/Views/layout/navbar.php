<nav class="top-navbar">
    <div class="container">
        <div class="row">
            <div class="col-4 top-navbar-list text-start">
                <a href="#" class="text-decoration-none link-success">
                    <h4><i class="fas fa-baby"></i> <strong>Kebidanan</strong></h4>
                </a>
            </div>
            <div class="col-4 text-center">
                <form action="">
                    <div class="input-group mt-2 pt-1">
                        <input type="search" name="cari" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="button-addon2">
                        <button class="btn btn-outline-success" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-4 top-navbar-list text-end">
                <?php if (session()->get('logged_in') == true) : ?>
                    <a class="link-success text-decoration-none" href="<?= "/login/logout" ?>">Keluar</a>
                <?php else : ?>
                    <a class="link-success text-decoration-none" href="<?= "/" ?>">Masuk</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-sm navbar-light bg-light sub-navbar" id="sticky-navbar">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#top">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about_us">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#our_services">
                        Layanan Kami
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#our_partners">
                        Cabang
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>