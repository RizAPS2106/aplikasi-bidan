<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-auto">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Borobudur_Temple.jpg/320px-Borobudur_Temple.jpg" />
    </div>
    <div class="col">
        <h3 class="h3"><?= $konsumen['nama'] ?></h3>
        <span>di <b><?= $konsumen['alamat'] ?></b></span>
        <div>Telepon <b><?= $konsumen['telepon'] ?></b></div>
    </div>
</div>

<?= $this->endSection() ?>