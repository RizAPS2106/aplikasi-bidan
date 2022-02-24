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
                        <a href="<?= base_url('konsumen/saldo'); ?>" class="text-decoration-none link-success">
                            <li class="list-group-item">Saldo</li>
                        </a>

                        <li class="list-group-item bg-success text-light">Alamat</li>

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
                    <h4 class="h4 mb-4 text-success">Alamat</h4>
                    <div class="mb-3" id="form_alamat">
                        <div class="row">
                            <div class="col">
                                <select class="select2 form-control" name="id_alamat" id="id_alamat">
                                    <?php if ($alamat != null) { ?>
                                        <option value='<?= $alamat['id']; ?>' selected><?= ucfirst($alamat['alamat']) ?></option>
                                    <?php } ?>
                                    <?php foreach ($alamat_disable as $alamats) : ?>
                                        <option value='<?= $alamats['id']; ?>'><?= ucfirst($alamats['alamat']) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class=" col">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#alamatModal">
                                    Tambah Alamat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="alamatModal" tabindex="-1" aria-labelledby="alamatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-light">
                <h5 class="modal-title" id="alamatModalLabel">Tambah Alamat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="addalamat_form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?= base_url('konsumen/alamat/add'); ?>" id="addalamat_url">
                    <input type="submit" class="btn btn-success" value="Tambahkan Alamat" id="addalamat">
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('layout/footer'); ?>