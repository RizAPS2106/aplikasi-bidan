<?= $this->include('layout/header') ?>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6 mt-3">
            <center>
                <h1>Masuk</h1>
            </center>

            <form method="post" id="auth_form">
                <?= csrf_field(); ?>
                <div class="my-3">
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                        <div class="invalid-feedback">
                            Isi kolom email dengan valid
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="password">Password</label>
                        <div class="col">
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="invalid-feedback">
                            Isi kolom password dengan minimal 8 karakter
                        </div>
                    </div>
                    <div class="form-group my-3 d-grid gap-2">
                        <input type="hidden" value="<?php echo base_url('login/auth/'); ?>" id="auth_url">
                        <input type="submit" class="btn btn-success" value="Masuk" id="auth">
                    </div>
                    <div class="form-group my-2">
                        <center>
                            <label>Belum punya akun?</label><a href="<?= base_url('register'); ?>">Daftar</a>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>