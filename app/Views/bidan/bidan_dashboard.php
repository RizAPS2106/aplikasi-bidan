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

<?= $this->extend('bidan/layout/bidan_layout') ?>

<?= $this->section('content') ?>

<!-- Content Row -->
<div class="row">
    <div class="col">
        <h3 class="h3 mb-4">Pesanan Masuk</h3>
    </div>
</div>

<div class="row">
    <?php if ($order != null) { ?>
        <?php foreach ($order as $orders) : ?>
            <div class="col-12 mb-3">
                <div class="card border-success">
                    <div class="card-body">
                        <h5 class="card-title text-success"><b><?= ucfirst($orders['nama']) ?></b></h5>
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <tr>
                                        <td>Layanan</td>
                                        <td> : </td>
                                        <td><?= $orders['list_layanan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td> : </td>
                                        <td><?= rupiah($orders['total_harga']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jadwal</td>
                                        <td> : </td>
                                        <td><?= $orders['jadwal']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table">
                                    <tr>
                                        <td>Pelayanan</td>
                                        <td> : </td>
                                        <td><?= $orders['layanan_detail']; ?></td>
                                    </tr>
                                    <?php if ($orders['layanan_detail'] == 'homecare') : ?>
                                        <tr>
                                            <td>Alamat</td>
                                            <td> : </td>
                                            <td><?= rupiah($orders['total_harga']); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>

                        <a href="#" class="btn btn-success float-end">Terima Pesanan</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } else { ?>
        <text class="text-secondary">Tidak ada pesanan masuk</text>
    <?php } ?>
</div>

<hr>

<div class="row">
    <div class="col">
        <h3 class="h3 mb-4">Riwayat Pesanan</h3>
    </div>
</div>

<div class="row">
    <?php if ($order_done != null) { ?>
        <?php foreach ($order_done as $order_dones) : ?>
            <div class="col-12 mb-3">
                <div class="card border-success">
                    <div class="card-body">
                        <h5 class="card-title text-success"><b><?= ucfirst($order_dones['nama']) ?></b></h5>
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <tr>
                                        <td>Layanan</td>
                                        <td> : </td>
                                        <td><?= $order_dones['list_layanan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td> : </td>
                                        <td><?= rupiah($order_dones['total_harga']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jadwal</td>
                                        <td> : </td>
                                        <td><?= $order_dones['jadwal']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table">
                                    <tr>
                                        <td>Pelayanan</td>
                                        <td> : </td>
                                        <td><?= $order_dones['layanan_detail']; ?></td>
                                    </tr>
                                    <?php if ($order_dones['layanan_detail'] == 'homecare') : ?>
                                        <tr>
                                            <td>Alamat</td>
                                            <td> : </td>
                                            <td><?= rupiah($order_dones['total_harga']); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>

                        <a href="#" class="btn btn-success float-end" target="_blank">Detail Pesanan</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } else { ?>
        <text class="text-secondary">Tidak ada riwayat pesanan</text>
    <?php } ?>
</div>

<?= $this->endSection(); ?>