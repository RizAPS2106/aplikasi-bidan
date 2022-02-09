<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('pesan')) : ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><?= session()->getFlashdata('pesan') ?></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<div class="col-auto mb-3">
  <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus mx-1"></i>Tambah Data Konsumen</button>
</div>

<table class="table py-1 align-middle" id="konsumen_table">
  <thead class="bg-success ">
    <tr class="text-white">
      <th>#</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Telepon</th>
      <th>
        <center>Aksi</center>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
    foreach ($konsumens as $konsumen) :
      $no++;
    ?>
      <tr>
        <td><?= $no; ?></td>
        <td>
          <?= $konsumen['nama'] ?><br>
        </td>
        <td>
          <?= $konsumen['telepon'] ?><br>
        </td>
        <td>
          <?= $konsumen['email'] ?><br>
        </td>
        <td>
          <center>
            <a href="<?= base_url('admin/konsumen/' . $konsumen['id'] . '/preview') ?>" class="btn btn-sm btn-outline-secondary" target="_blank"><i class="fa fa-search-plus"></i> Detail</a>
            <a href="javascript:;" class="btn btn-sm btn-outline-primary item_edit" data="<?php echo $konsumen['id']; ?>"><i class="far fa-edit"></i> Ubah</a>
            <a href="javascript:;" class="btn btn-sm btn-outline-danger item_delete" data="<?= $konsumen['id']; ?>"><i class="far fa-trash-alt"></i> Hapus</a>
          </center>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

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
              </div>
              <div class="col">
                <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Konfirmasi password">
              </div>
            </div>
            <input type="hidden" id="password_invalid">
            <div class="invalid-feedback">
              Isi kolom password dengan minimal 8 karakter
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" value="<?php echo base_url('admin/konsumen/create/'); ?>" id="create_url">
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
            <label type="button" for="password" id="ubah_password" class="w-100 dropdown-toggle">Ubah Password</label>
            <div id="form_ubah_password" style="display: none;" class="mt-3">
              <input type="password" name="first_password" class="form-control" id="first_passwords" placeholder="Password lama">
              <div>
                <div class="row my-2">
                  <div class="col">
                    <input type="password" name="password" class="form-control" id="passwords" placeholder="Password baru">
                  </div>
                  <div class="col">
                    <input type="password" name="password_confirm" class="form-control" id="password_confirms " placeholder="Konfirmasi password">
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
          <input type="hidden" value="<?php echo base_url('admin/konsumen/edit/'); ?>" id="edit_url">
          <input type="submit" class="btn btn-success" value="Simpan" id="edit">
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>