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

if ($invoice['max_invoice'] == null) {
    $invoice_id = "ORD001";
} else {
    $angka = (int) substr($invoice['max_invoice'], 3, 3);
    $angka++;
    $huruf = 'ORD';
    $invoice_id = $huruf . sprintf("%03s", $angka);
}
?>

<?= $this->include('layout/header'); ?>

<header class="bg-light border border-success mb-3">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="h1 my-3 text-success">Pesan Layanan</h1>
            </div>
        </div>
    </div>
</header>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <form method="POST" id="order_form">
                <div class="mb-3">
                    <label for="invoice" class="form-label">Invoice</label>
                    <input name="invoice" class="form-control" type="text" value="<?= $invoice_id; ?>" aria-label="readonly input example" readonly>
                </div>
                <div class="mb-3">
                    <label for="layanan[]" class="form-label">Layanan</label>
                    <select class="select2 form-control" name="layanan[]" multiple="multiple" id="layanan">
                        <?php foreach ($layanan as $layanans) : ?>
                            <option value='{"id":"<?= $layanans['id']; ?>","harga":<?= $layanans['harga']; ?>}'><?= ucfirst($layanans['nama_layanan']) . ' - ' . rupiah($layanans['harga']); ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jadwal" class="form-label">Jadwal</label>
                    <input name="jadwal" type="text" value="<?= date('Y/m/d H:i:s'); ?>" class="datetimepicker form-control">
                </div>
                <div class="mb-3">
                    <label for="layanan_detail" class="my-2">Pilih pelayanan</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layanan_detail" id="radio1" checked="checked" value="onsite">
                        <label class="form-check-label" for="radio1">
                            Onsite
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layanan_detail" id="radio2" value="homecare">
                        <label class="form-check-label" for="radio2">
                            Homecare
                        </label>
                    </div>
                </div>
                <div class="mb-3" id="form_alamat" style="display: none;">
                    <label for="alamat" class="my-2">Alamat</label><br>
                    <div class="row">
                        <div class="col">
                            <select class="select2 form-control" name="id_alamat" id="id_alamat">
                                <?php if ($alamat != null) { ?>
                                    <option value='<?= $alamat['id']; ?>'><?= ucfirst($alamat['alamat']) ?></option>
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
                <div class="mb-3" id="total">
                    <input type="hidden" name="total_harga" id="total_harga">
                    <h5 class="text-center"><strong> TOTAL : Rp. <label class="uang" id="harga_total">0</label>,00</strong></h3>
                </div>
                <input type="hidden" value="<?= base_url('pesan/create/'); ?>" id="order_url">
                <center>
                    <input type="submit" class="btn btn-success rounded-pill my-3 w-75" value="Pesan" id="order">
                </center>
            </form>
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
            <form method="POST" action="<?= base_url('pesan/create/addalamat'); ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?= base_url('pesan/create/addalamat'); ?>" id="addalamat_url">
                    <input type="submit" class="btn btn-success" value="Tambahkan Alamat" id="addalamat">
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->include('layout/footer'); ?>