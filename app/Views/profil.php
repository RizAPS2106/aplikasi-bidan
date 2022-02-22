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
        <div class="col-4">
            <div class="card border-success" style="height:33rem;">
                <div class="card-body">
                    <center>
                        <img src="/img/notfound.png" width="200" height="200" alt="...">
                    </center>
                    <ul class="list-group">
                        <li class="list-group-item bg-success text-light" aria-current="true">Profil</li>
                        <a href="<?= base_url('konsumen/saldo'); ?>" class="text-decoration-none link-success">
                            <li class="list-group-item">Saldo</li>
                        </a>
                        <a href="#" class="text-decoration-none link-success">
                            <li class="list-group-item">Riwayat Pemesanan</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-success h-100">
                <div class="card-body">
                    <form method="post" id="edit_form">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <input type="hidden" name="id" class="form-control" id="id" value="<?= session()->get('id_user'); ?>">
                            <div class="form-group my-2">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control profil_field" id="namas" value="<?= $profil['nama']; ?>" readonly>
                                <div class="invalid-feedback">
                                    Isi kolom nama
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" class="form-control profil_field" onkeypress="return isNumberKey(event)" id="telepons" value="<?= $profil['telepon']; ?>" readonly>
                                <div class="invalid-feedback">
                                    Isi kolom nomor telepon dengan nomor minimal 10 digit.
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control profil_field" id="emails" value="<?= $profil['email']; ?>" readonly>
                                <div class="invalid-feedback">
                                    Isi kolom email dengan valid
                                </div>
                            </div>

                            <hr>

                            <div class="form-group my-2">
                                <label type="button" for="password" class="w-100 dropdown-toggle" id="ubah_password">Ubah Password</label>
                                <div id="form_ubah_password" class="mt-3" style="display: none;">
                                    <input type="password" name="password_lama" class="form-control profil_password_field" id="password_lamas" placeholder="Password lama" disabled>
                                    <div>
                                        <div class="row my-2">
                                            <div class="col">
                                                <input type="password" name="password" class="form-control profil_password_field" id="passwords" placeholder="Password baru" disabled>
                                            </div>
                                            <div class="col">
                                                <input type="password" name="konfirmasi_password" class="form-control profil_password_field" id="konfirmasi_passwords" placeholder="Konfirmasi password" disabled>
                                            </div>
                                        </div>
                                        <input type="hidden" id="password_invalids">
                                        <div class="invalid-feedback">
                                            Isi kolom password dengan minimal 8 karakter
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="<?= base_url('/konsumen/profil/edit'); ?>" id="edit_url">
                            <div id="enable_button">
                                <button type="button" class="btn btn-success" id="enable_form">Ubah</button>
                            </div>
                            <div id="ubah_button" style="display: none;">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-outline-danger" id="batal_ubah">Batal</button>
                                    </div>
                                    <div class="col">
                                        <input type="submit" class="btn btn-success" value="Ubah" id="edit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->include('layout/footer'); ?>