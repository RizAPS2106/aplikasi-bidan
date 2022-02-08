<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('pesan')) : ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('pesan') ?>
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
          <?= $konsumen['alamat'] ?><br>
        </td>
        <td>
          <?= $konsumen['telepon'] ?><br>
        </td>
        <td>
          <center>
            <a href="<?= base_url('admin/konsumen/' . $konsumen['id'] . '/preview') ?>" class="btn btn-sm btn-outline-secondary" target="_blank"><i class="fa fa-search-plus"></i> Detail</a>
            <a href="javascript:;" class="btn btn-sm btn-outline-primary item_edit" data="<?php echo $konsumen['id']; ?>"><i class="far fa-edit"></i> Ubah</a>
            <a href="<?= base_url('admin/konsumen/' . $konsumen['id'] . '/delete') ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus ?')"><i class="far fa-trash-alt"></i> Hapus</a>
          </center>
        </td>
      </tr>

      <!-- Update Modal -->
      <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-success text-light">
              <h5 class="modal-title" id="exampleModalLabel">Ubah Data Konsumen</h5>
              <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="edit_form">
              <div class="modal-body">
                <div class="form-group my-2">
                  <input type="hidden" name="id" class="form-control" value="<?= $konsumen['id']; ?>">
                </div>
                <div class="form-group my-2">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" class="form-control" value="<?= $konsumen['nama']; ?>">
                </div>
                <div class="form-group my-2">
                  <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat"><?= $konsumen['alamat']; ?></textarea>
                </div>
                <div class="form-group my-2">
                  <label for="telepon">Telepon</label>
                  <input type="text" name="telepon" class="form-control" value="<?= $konsumen['telepon']; ?>">
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

    <?php endforeach ?>
  </tbody>
</table>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-light">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Konsumen</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="create_form">
        <div class="modal-body">
          <div class="form-group my-2">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control">
          </div>
          <div class="form-group my-2">
            <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat"></textarea>
          </div>
          <div class="form-group my-2">
            <label for="telepon">Telepon</label>
            <input type="text" name="telepon" class="form-control">
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

<?= $this->endSection() ?>