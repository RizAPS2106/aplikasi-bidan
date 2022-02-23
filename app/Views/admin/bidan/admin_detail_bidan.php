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
                    <h3 class="h3 text-success"><b><?= ucfirst($bidan['nama']) ?></b></h3>

                    <table class="table mt-3">
                        <tr>
                            <th>Email</th>
                            <td> : </td>
                            <td><?= $bidan['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td> : </td>
                            <td><?= $bidan['telepon'] ?></td>
                        </tr>
                        <tr>
                            <th>Cabang</th>
                            <td> : </td>
                            <td>
                                <?php if ($bidan['nama_cabang'] != null) {
                                    echo $bidan['nama_cabang'];
                                } else {
                                    echo '-';
                                } ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</center>

<?= $this->endSection() ?>