<?= $this->extend('admin/layout/admin_layout') ?>

<?= $this->section('content') ?>

<center>
    <div class="card " style="width: auto;height :auto">
        <div class="card-body" style="text-align: left;">
            <div class="row">
                <div class="col-auto">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Borobudur_Temple.jpg/320px-Borobudur_Temple.jpg" style="width: 30rem;" />
                </div>
                <div class=" col-auto">
                    <h3 class="h3"><?= $profil['nama'] ?></h3>
                    <div>Email <b><?= $profil['email'] ?></b></div>
                    <div>Telepon <b><?= $profil['telepon'] ?></b></div>

                    <a href="javascript:;" class="btn btn-sm btn-success my-3 item_edit" data="<?= session()->get('id_user'); ?>">Ubah profil</a>
                </div>

                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-light">
                                <h5 class="modal-title" id="updateModalLabel">Ubah Profil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" id="edit_form">
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <input type="hidden" name="id" class="form-control" id="id">
                                    <div class="form-group my-2">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="namas">
                                        <div class="invalid-feedback">
                                            Isi kolom nama
                                        </div>
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" name="telepon" class="form-control" onkeypress="return isNumberKey(event)" id="telepons">
                                        <div class="invalid-feedback">
                                            Isi kolom nomor telepon dengan nomor minimal 10 digit.
                                        </div>
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="emails">
                                        <div class="invalid-feedback">
                                            Isi kolom email dengan valid
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group my-2">
                                        <label type="button" for="password" class="w-100 dropdown-toggle" id="ubah_password">Ubah Password</label>
                                        <div id="form_ubah_password" class="mt-3" style="display: none;">
                                            <input type="password" name="password_lama" class="form-control" id="password_lamas" placeholder="Password lama">
                                            <div>
                                                <div class="row my-2">
                                                    <div class="col">
                                                        <input type="password" name="password" class="form-control" id="passwords" placeholder="Password baru">
                                                    </div>
                                                    <div class="col">
                                                        <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_passwords" placeholder="Konfirmasi password">
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
                                    <input type="hidden" value="<?= base_url('admin/user/edit'); ?>" id="edit_url">
                                    <input type="submit" class="btn btn-success" value="Ubah" id="edit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>

<?= $this->endSection() ?>