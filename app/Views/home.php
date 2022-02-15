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
                    <div class="card border-success text-center mb-4">
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
                            <a href="#" class="btn btn-success w-100 my-2 rounded-pill">Pesan</a>
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

<?= $this->endSection(); ?>