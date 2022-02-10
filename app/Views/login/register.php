<?= $this->include('layout/header') ?>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6 mt-3">
            <h1>Daftar</h1>

            <form method="post" id="create_form">
                <?= csrf_field(); ?>
                <div class="my-3">
                    <div class="form-group my-2">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama">
                        <div class="invalid-feedback">
                            Isi kolom nama
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" class="form-control" onkeypress="return isNumberKey(event)" id="telepon">
                        <div class="invalid-feedback">
                            Isi kolom nomor telepon dengan nomor minimal 10 digit.
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                        <div class="invalid-feedback">
                            Isi kolom email dengan valid
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="password">Password</label>
                        <div class="row">
                            <div class="col">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="col">
                                <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password" placeholder="Konfirmasi password">
                            </div>
                        </div>
                        <input type="hidden" id="password_invalid">
                        <div class="invalid-feedback">
                            Isi kolom password dengan minimal 8 karakter
                        </div>
                    </div>
                    <div class="form-group my-3 d-grid gap-2">
                        <input type="hidden" name="group_user" value="0">
                        <input type="hidden" value="<?php echo base_url('register/register/'); ?>" id="create_url">
                        <input type="submit" class="btn btn-success" value="Daftar" id="create">
                    </div>
                    <div class="form-group my-2">
                        <center>
                            <label>Sudah memiliki akun?</label><a href="<?= base_url('/'); ?>">Masuk</a>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>