<?= $this->extend('admin/layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="mb-3">
    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus"></i> Tambah Data cabang</button>
</div>

<table class="table py-1 align-middle" id="cabang_table">
    <thead class="bg-success text-light">
        <tr>
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
        foreach ($cabang as $cabangs) :
            $no++;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td>
                    <?= $cabangs['kode_cabang'] ?><br>
                </td>
                <td>
                    <?= $cabangs['nama'] ?><br>
                </td>
                <td>
                    <?= $cabangs['alamat'] ?><br>
                </td>
                <td>
                    <center>
                        <a href="<?= base_url('admin/cabang/' . $cabangs['id'] . '/preview') ?>" class="btn btn-sm btn-outline-secondary" target="_blank"><i class="fas fa-search-plus"></i> Detail</a>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary item_edit" data="<?= $cabangs['id']; ?>"><i class="far fa-edit"></i> Ubah</a>
                        <a href="javascript:;" class="btn btn-sm btn-outline-danger item_delete" data="<?= $cabangs['id']; ?>"><i class="far fa-trash-alt"></i> Hapus</a>
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
                <h5 class="modal-title" id="createModalLabel">Tambah Data Cabang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="create_form">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group my-2">
                        <label for="nama">Kode Cabang</label>
                        <input type="text" name="kode_cabang" class="form-control" id="kode_cabang">
                        <div class="invalid-feedback">
                            Isi kolom kode cabang minimal 5 karakter
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama">
                        <div class="invalid-feedback">
                            Isi kolom nama
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                        <div class="invalid-feedback">
                            Isi kolom alamat
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="group_user" value="3">
                    <input type="hidden" value="<?= base_url('admin/cabang/create/'); ?>" id="create_url">
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
                <h5 class="modal-title" id="updateModalLabel">Ubah Data cabang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="edit_form">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="id" class="form-control">
                    <div class="form-group my-2">
                        <label for="kode_cabang">Kode Cabang</label>
                        <input type="text" name="kode_cabang" class="form-control" id="kode_cabangs">
                        <div class="invalid-feedback">
                            Isi kolom nomor kode cabang dengan nomor minimal 10 digit.
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="namas">
                        <div class="invalid-feedback">
                            Isi kolom nama
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamats" rows="3"></textarea>
                        <div class="invalid-feedback">
                            Isi kolom alamat
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?= base_url('admin/cabang/edit/'); ?>" id="edit_url">
                    <input type="submit" class="btn btn-success" value="Ubah" id="edit">
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>