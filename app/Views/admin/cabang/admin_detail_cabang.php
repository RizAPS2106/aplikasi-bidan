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
                    <h3 class="h3 text-success"><b><?= ucfirst($cabang['nama']) ?></b></h3>

                    <table class="table mt-3">
                        <tr>
                            <th>Owner</th>
                            <td> : </td>
                            <td><?= ucfirst($cabang['nama_user']) ?></td>
                        </tr>
                        <tr>
                            <th>Kode Cabang</th>
                            <td> : </td>
                            <td><?= $cabang['kode_cabang'] ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td> : </td>
                            <td><?= ucfirst($cabang['alamat']) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</center>

<?= $this->endSection() ?>