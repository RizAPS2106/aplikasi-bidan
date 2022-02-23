<?= $this->extend('admin/layout/admin_layout') ?>

<?= $this->section('content') ?>

<center>
    <div class="card">
        <div class="card-body text-start">
            <div class="row">
                <div class="col-auto">
                    <img src="/img/notfound.png" width="300" height="300">
                </div>
                <div class="col mt-auto mb-auto ">
                    <h3 class="h3 text-success"><b><?= ucfirst($owner['nama']) ?></b></h3>

                    <table class="table mt-3">
                        <tr>
                            <th>Email</th>
                            <td> : </td>
                            <td><?= $owner['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td> : </td>
                            <td><?= $owner['telepon'] ?></td>
                        </tr>
                        <tr>
                            <th>Cabang</th>
                            <td> : </td>
                            <td><?= $owner['nama_cabang'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</center>

<?= $this->endSection() ?>