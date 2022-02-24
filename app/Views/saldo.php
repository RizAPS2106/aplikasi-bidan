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

<?= $this->include('layout/header'); ?>

<div class="container my-5">

    <div class="row">
        <div class="col-sm-4">
            <div class="card border-success" style="height:33rem;">
                <div class="card-body">
                    <center>
                        <img src="/img/notfound.png" class="img-thumbnail mb-4" width="200" height="200" alt="...">
                    </center>
                    <ul class="list-group">
                        <a href="<?= base_url('konsumen'); ?>" class="text-decoration-none">
                            <li class="list-group-item link-success" aria-current="true">Profil</li>
                        </a>

                        <li class="list-group-item bg-success text-light">Saldo</li>

                        <a href="<?= base_url('konsumen/alamat'); ?>" class="text-decoration-none link-success">
                            <li class="list-group-item">Alamat</li>
                        </a>
                        <a href="#" class="text-decoration-none link-success">
                            <li class="list-group-item">Riwayat Pemesanan</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h4 class="h4 mb-4 text-success">Saldo</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        <input type="text" class="form-control" placeholder="saldo" aria-label="saldo" aria-describedby="basic-addon1" readonly value="<?= rupiah_norp($profil['saldo']); ?>">
                    </div>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addsaldoModal">
                        Tambah Saldo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="addsaldoModal" tabindex="-1" aria-labelledby="addsaldoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="addsaldoModalLabel">Tambah Saldo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="edit_form">
                    <div class="modal-body">
                        <?= csrf_field(); ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="saldo" class="form-control uang" placeholder="0" aria-label="saldo" aria-describedby="basic-addon1" id="saldos" onkeypress="return isNumberKey(event)">
                            <div class="invalid-feedback">
                                Harap isi saldo dengan angka yang lebih besar dari 0
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="<?= base_url('/konsumen/saldo/add'); ?>" id="edit_url">
                        <input type="submit" class="btn btn-success" value="Tambahkan" id="edit">
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<?= $this->include('layout/footer'); ?>