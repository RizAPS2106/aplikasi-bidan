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

<?= $this->extend('admin/layout/admin_layout') ?>

<?= $this->section('content') ?>

<center>
    <div class="card">
        <div class="card-body text-start">
            <div class="row">
                <div class="col-auto">
                    <img src="/img/notfound.png" class="img-thumbnail mb-2" width="300" height="300">
                </div>
                <div class="col mt-auto mb-auto ">
                    <h3 class="h3 text-success"><b><?= ucfirst($konsumen['nama']) ?></b></h3>

                    <div class="table-responsive-sm">
                        <table class="table mt-3">
                            <tr>
                                <th>Email</th>
                                <td> : </td>
                                <td><?= $konsumen['email'] ?></td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td> : </td>
                                <td><?= $konsumen['telepon'] ?></td>
                            </tr>
                            <tr>
                                <th>Saldo</th>
                                <td> : </td>
                                <td><?= rupiah($konsumen['saldo']) ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td> : </td>
                                <td>
                                    <?php if ($alamat != null) { ?>
                                        <text><u><?= $alamat['alamat'] ?></u> / </text>
                                    <?php } else {
                                        echo '-';
                                    } ?>
                                    <?php foreach ($alamat_disable as $alamats) :
                                        echo $alamats['alamat'] . ' / ';
                                    endforeach ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>

<?= $this->endSection() ?>