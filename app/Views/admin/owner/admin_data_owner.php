<?= $this->extend('admin/layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="mb-3">
    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus"></i> Tambah Data owner</button>
</div>

<table class="table py-1 align-middle" id="user_table">
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
        foreach ($owner as $owners) :
            $no++;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td>
                    <?= $owners['nama'] ?><br>
                </td>
                <td>
                    <?= $owners['telepon'] ?><br>
                </td>
                <td>
                    <?= $owners['email'] ?><br>
                </td>
                <td>
                    <center>
                        <a href="<?= base_url('admin/owner/' . $owners['id'] . '/preview') ?>" class="btn btn-sm btn-outline-secondary" target="_blank"><i class="fas fa-search-plus"></i> Detail</a>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary item_edit" data="<?= $owners['id']; ?>"><i class="far fa-edit"></i> Ubah</a>
                        <a href="javascript:;" class="btn btn-sm btn-outline-danger item_delete" data="<?= $owners['id']; ?>"><i class="far fa-trash-alt"></i> Hapus</a>
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
                <h5 class="modal-title" id="createModalLabel">Tambah Data Owner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password" placeholder="Konfirmasi password">
                            </div>
                        </div>
                        <input type="hidden" id="password_invalid">
                        <div class="invalid-feedback">
                            Isi kolom password dengan minimal 8 karakter
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="select_cabang">Cabang</label>
                        <select name="id_cabang" class="select2" style="width: 100%;">
                            <option disabled selected value> -- Pilih Cabang -- </option>
                            <?php foreach ($cabang as $cbg) : ?>
                                <option value="<?= $cbg['id'] ?>"><?= $cbg['id'] . ' - ' . ucfirst($cbg['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="group_user" value="1">
                    <input type="hidden" value="<?= base_url('admin/user/create/'); ?>" id="create_url">
                    <input type="submit" class="btn btn-success" value="Ubah" id="create">
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
                <h5 class="modal-title" id="updateModalLabel">Ubah Data Owner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="edit_form">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="id" class="form-control">
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
                    <div class="form-group my-2">
                        <label for="select_cabang">Cabang</label>
                        <select name="id_cabang" class="select2" style="width: 100%;">
                            <option disabled selected value> -- Pilih Cabang -- </option>
                            <?php foreach ($cabang as $cbg) : ?>
                                <option value="<?= $cbg['id'] ?>"><?= $cbg['id'] . ' - ' . ucfirst($cbg['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
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
                                        <input type="password" name="password_konfirmasi" class="form-control" id="password_konfirmasis" placeholder="Konfirmasi password">
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
                    <input type="hidden" value="<?= base_url('admin/user/edit/'); ?>" id="edit_url">
                    <input type="submit" class="btn btn-success" value="Ubah" id="edit">
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>