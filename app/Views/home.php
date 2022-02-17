<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function rupiah_norp($angka)
{
    $hasil_rupiah = number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<div id="carouselExampleCaptions" class="carousel slide my-4" data-bs-ride="carousel">
    <div class="container">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/bidan01.jpg" class="d-block w-100 carousel-size" alt="...">
                <div class="carousel-caption d-none d-md-block text-neon">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/bidan02.png" class="d-block w-100 carousel-size" alt="...">
                <div class="carousel-caption d-none d-md-block text-neon">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/bidan03.jpg" class="d-block w-100 carousel-size" alt="...">
                <div class="carousel-caption d-none d-md-block text-neon">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev carousel-dark" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next carousel-dark" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container my-3">

    <section id="about_us">
        <h3 class="mt-5 text-center">Tentang Kami</h3>
        <hr class="hr-short">
        <div class="bg-light">
            <div class="container">
                <div class="row text-justify p-5">
                    <div class="col-md-6">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus, quae reprehenderit, magni eos sed dolorem, unde qui totam voluptatem facere ea ratione cumque? Voluptatem nostrum laudantium delectus, odit itaque suscipit.
                    </div>
                    <div class="col-md-6">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus, quae reprehenderit, magni eos sed dolorem, unde qui totam voluptatem facere ea ratione cumque? Voluptatem nostrum laudantium delectus, odit itaque suscipit.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="our_services">
        <h3 class="mt-5 text-center">Layanan Kami</h3>
        <hr class="hr-short">
        <div class="row">
            <?php foreach ($layanan as $layanans) : ?>
                <div class="col-md-4">
                    <div class=" card border-success text-center mb-4">
                        <div class="card-header">
                            <h3><strong><?= ucfirst($layanans['nama_layanan']); ?></strong></h3>
                            <span><?= rupiah($layanans['harga']); ?></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                                <li class="list-group-item">A fourth item</li>
                                <li class="list-group-item">And a fifth one</li>
                            </ul>
                        </div>
                        <div class="card-footer text-muted">
                            <?php if (session()->get('logged_in') == true) { ?>
                                <a href="<?= base_url('pesan'); ?>" class="btn btn-success w-100 my-2 rounded-pill" target="_blank">Pesan</a>
                            <?php } else { ?>
                                <button type="button" class="btn btn-sm btn-success w-100 my-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Pesan
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="our_partners">
        <h3 class="mt-5 text-center">Cabang Bidan yang Terdaftar</h3>
        <hr class="hr-short">
        <div class="row">
            <?php foreach ($cabang as $cabangs) : ?>
                <div class="col-md-3 my-3 mx-2 text-center">
                    <img src="/img/notfound.png" alt="..." class="img-thumbnail mb-1">
                    <h4><?= ucfirst($cabangs['nama']); ?></h4>
                    <span>Alamat : <?= ucfirst($cabangs['alamat']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="auth_form">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button><br>
                    <h4 class="text-center text-success">Masuk</h4>
                    <?= csrf_field(); ?>
                    <div class="my-3">
                        <div class="form-group my-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                            <div class="invalid-feedback">
                                Isi kolom email dengan valid
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <label for="password">Password</label>
                            <div class="col">
                                <input type="password" name="password" class="form-control" id="password">
                                <div class="invalid-feedback">
                                    Isi kolom password dengan minimal 8 karakter
                                </div>
                            </div>
                        </div>
                        <div class="form-group my-3 d-grid gap-2">
                            <input type="hidden" value="<?php echo base_url('login/auth/'); ?>" id="auth_url">
                            <input type="submit" class="btn btn-success" value="Masuk" id="auth">
                        </div>
                        <div class="form-group my-2 text-center">
                            <label>Belum punya akun?</label><a href="<?= base_url('register'); ?>">Daftar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="text-center text-lg-start bg-light text-success">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom border-top">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Sosial Media Kami :</span>
        </div>

        <!-- Right -->
        <div>
            <a href="" class="me-4 text-success text-decoration-none">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="me-4 text-success text-decoration-none">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="me-4 text-success text-decoration-none">
                <i class="fab fa-google"></i>
            </a>
            <a href="" class="me-4 text-success text-decoration-none">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-success text-decoration-none">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="" class="me-4 text-success text-decoration-none">
                <i class="fab fa-github"></i>
            </a>
        </div>
    </section>

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-baby me-3"></i>Kebidanan
                    </h6>
                    <p class="text-justify">
                        Here you can use rows and columns to organize your footer content. Lorem ipsum
                        dolor sit amet, consectetur adipisicing elit.
                    </p>
                </div>

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Tautan Berguna
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">Link 1</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Link 2</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Link 3</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Link 4</a>
                    </p>
                </div>

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Kontak
                    </h6>
                    <p><i class="fas fa-home me-3"></i> -, ----, --</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 00 000 000 01</p>
                    <p><i class="fas fa-print me-3"></i> + 00 000 000 02</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © <?= date('Y'); ?> Copyright:
        <a class="text-reset fw-bold" href="https://oranyesoftwarehouse.com/">Kebidanan.com</a>
    </div>
</footer>

<?= $this->endSection(); ?>