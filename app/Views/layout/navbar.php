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
                    <li class="list-unstyled">
                        <div class="dropdown">
                            <a class="text-decoration-none link-success" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="overflow">
                                    <text><?= session()->get('nama_user') ?></text>
                                </div>
                                <i class="fas fa-user-circle"></i> <i class="fas fa-caret-down"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="<?= base_url('konsumen/profil'); ?>" target="_blank">Profil</a></li>
                                <li><a class="dropdown-item" href="#">Riwayat Pesanan</a></li>
                                <li><a class="dropdown-item link-danger" href="#" id="logout"> Keluar</a></li>
                            </ul>
                        </div>
                    </li>
                <?php else : ?>
                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Masuk
                    </button>
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
                <?php if (session()->get('logged_in') == true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Riwayat Pesanan
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>