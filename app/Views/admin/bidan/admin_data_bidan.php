<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('pesan')) : ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><?= session()->getFlashdata('pesan') ?></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<div class="mb-3">
  <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus mx-1"></i>Tambah Data Bidan</button>
</div>

<table class="table py-1 align-middle" id="bidan_table">
  <thead class="bg-success">
    <tr class="text-light">
      <th>#</th>
      <th>Nama</th>
      <th>Telepon</th>
      <th>Email</th>
      <th>
        <center>Aksi</center>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
    foreach ($bidans as $bidan) :
      $no++;
    ?>
      <tr>
        <td><?= $no; ?></td>
        <td>
          <?= $bidan['nama'] ?><br>
        </td>
        <td>
          <?= $bidan['telepon'] ?><br>
        </td>
        <td>
          <?= $bidan['email'] ?><br>
        </td>
        <td>
          <center>
            <a href="<?= base_url('admin/bidan/' . $bidan['id'] . '/preview') ?>" class="btn btn-sm btn-outline-secondary" target="_blank"><i class="fas fa-search-plus"></i> Detail</a>
            <a href="javascript:;" class="btn btn-sm btn-outline-primary item_edit" data="<?php echo $bidan['id']; ?>"><i class="far fa-edit"></i> Ubah</a>
            <a href="<?= base_url('admin/bidan/' . $bidan['id'] . '/delete') ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')"><i class="far fa-trash-alt"></i> Hapus</a>
          </center>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php if (isset($_POST['msg'])) {
  $message = $_POST['msg'];
} else {
  $message = "Error";
} ?>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-light">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Bidan</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="create_form">
        <?= csrf_field(); ?>
        <div class="modal-body">
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
                <div class="invalid-feedback">
                  Isi kolom password dengan minimal 8 karakter
                </div>
              </div>
              <div class="col">
                <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Konfirmasi password">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" value="<?php echo base_url('admin/bidan/create/'); ?>" id="create_url">
          <input type="submit" class="btn btn-success" value="Simpan" id="create">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-light">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Bidan</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="edit_form">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <input type="hidden" name="id" class="form-control" id="id">
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

          <hr>

          <div class="form-group my-2">
            <label type="button" for="password" id="ubah_password" class="w-100 dropdown-toggle">Ubah Password</label>
            <div id="form_ubah_password" style="display: none;" class="mt-3">
              <input type="password" name="first_password" class="form-control" id="first_password" placeholder="Password lama">
              <div class="row my-2">
                <div class="col">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password baru">
                  <div class="invalid-feedback">
                    Isi kolom password dengan minimal 8 karakter
                  </div>
                </div>
                <div class="col">
                  <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Konfirmasi password">
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" value="<?php echo base_url('admin/bidan/edit/'); ?>" id="edit_url">
          <input type="submit" class="btn btn-success" value="Simpan" id="edit">
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>