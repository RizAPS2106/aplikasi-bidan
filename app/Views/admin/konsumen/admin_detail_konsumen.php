<?= $this->extend('admin/layout/admin_layout') ?>

<?= $this->section('content') ?>

<center>
    <div class="card" style="width: auto;height :auto">
        <div class="card-body text-start">
            <div class="row">
                <div class="col-auto">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Borobudur_Temple.jpg/320px-Borobudur_Temple.jpg" style="width: 30rem;">
                </div>
                <div class=" col-auto">
                    <h3 class="h3"><?= $konsumen['nama'] ?></h3>
                    <div>Email <b><?= $konsumen['email'] ?></b></div>
                    <div>Telepon <b><?= $konsumen['telepon'] ?></b></div>
                </div>
            </div>
        </div>
    </div>
</center>

<?= $this->endSection() ?>