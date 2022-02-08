<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<center>
    <div class="card " style="width: auto;height :auto">
        <div class="card-body" style="text-align: left;">
            <div class="row">
                <div class="col-auto">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Borobudur_Temple.jpg/320px-Borobudur_Temple.jpg" style="width: 20rem;" />
                </div>
                <div class=" col-auto">
                    <h3 class="h3"><?= $bidan['nama'] ?></h3>
                    <span>di <b><?= $bidan['alamat'] ?></b></span>
                    <div>Telepon <b><?= $bidan['telepon'] ?></b></div>
                </div>
            </div>
        </div>
    </div>
</center>

<?= $this->endSection() ?>