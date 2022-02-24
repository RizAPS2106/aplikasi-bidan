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

<?= $this->extend('admin/layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="col-auto mb-3">
    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus"></i> Tambah Layanan</button>
</div>

<div class="table-responsive">
    <table class="table py-1 align-middle" id="layanan_table">
        <thead class="bg-success text-white">
            <tr>
                <th>#</th>
                <th>Nama Layanan</th>
                <th>Harga</th>
                <th>
                    <center>Aksi</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            foreach ($layanan as $layanans) :
                $no++;
            ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td>
                        <?= $layanans['nama_layanan'] ?><br>
                    </td>
                    <td>
                        <?= rupiah($layanans['harga']) ?><br>
                    </td>
                    <td>
                        <center>
                            <a href="<?= base_url('admin/layanan/' . $layanans['id'] . '/preview') ?>" class="btn btn-sm btn-outline-secondary" target="_blank"><i class="fa fa-search-plus"></i> Detail</a>
                            <a href="javascript:;" class="btn btn-sm btn-outline-primary item_edit" data="<?php echo $layanans['id']; ?>"><i class="far fa-edit"></i> Ubah</a>
                            <a href="javascript:;" class="btn btn-sm btn-outline-danger item_delete" data="<?= $layanans['id']; ?>"><i class="far fa-trash-alt"></i> Hapus</a>
                        </center>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-light">
                <h5 class="modal-title" id="createModalLabel">Tambah Data Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="create_form">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group my-2">
                        <label for="nama_layanan">Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control" id="nama_layanan">
                        <div class="invalid-feedback">
                            Isi kolom nama layanan
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="harga">Harga</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="harga" class="form-control uang" aria-describedby="basic-addon1" onkeypress="return isNumberKey(event)" id="harga">
                            <div class="invalid-feedback">
                                Isi kolom harga
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="group_user" value="2">
                    <input type="hidden" value="<?= base_url('admin/layanan/create/'); ?>" id="create_url">
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
                <h5 class="modal-title" id="updateModalLabel">Ubah Data Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="edit_form">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="id" class="form-control">
                    <div class="form-group my-2">
                        <label for="nama_layanan">Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control" id="nama_layanans">
                        <div class="invalid-feedback">
                            Isi kolom nama layanan
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <label for="harga">Harga</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="harga" class="form-control uang" aria-describedby="basic-addon1" onkeypress="return isNumberKey(event)" id="hargas">
                            <div class="invalid-feedback">
                                Isi kolom harga
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?= base_url('admin/layanan/edit/'); ?>" id="edit_url">
                    <input type="submit" class="btn btn-success" value="Simpan" id="edit">
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>