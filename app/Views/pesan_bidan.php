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
    $angka = (int) substr($invoice, 3, 3);
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
                    <input name="jadwal" type="text" value="2021-04-16 14:45" class="datetimepicker form-control">
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
                    <textarea name="alamat" class="form-control"></textarea>
                </div>
                <div class="mb-3" id="total">
                    <h5 class="text-center"><strong> TOTAL : Rp. <label class="uang" id="harga_total">0</label></strong></h3>
                </div>
                <input type="hidden" value="<?= base_url('pesan/pesan/'); ?>" id="order_url">
                <center>
                    <input type="submit" class="btn btn-success rounded-pill mt-3 w-75" value="Pesan" id="order">
                </center>
            </form>
        </div>
    </div>
</div>

<?= $this->include('layout/footer'); ?>