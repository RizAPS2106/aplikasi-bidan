<?= $this->extend('admin/layout/admin_layout') ?>

<?= $this->section('content') ?>

<!-- Content Row -->
<div class="row">

    <!-- Card 1 -->
    <div class="col-xl-4 mb-4">
        <a href="#" class="text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2 bg-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                data admin
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo count($admin) ?></div>
                            <br>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users-cog text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 mb-4">
        <a href="#" class="text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2 bg-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                data konsumen
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo count($konsumen) ?></div>
                            <br>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-lg text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 mb-4">
        <a href="#" class="text-decoration-none">
            <div class="card border-success shadow h-100 py-2">
                <div class="card-body text-success">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class=" text-xs font-weight-bold text-uppercase mb-1">
                                data bidan
                            </div>
                            <div class="h5 mb-0 font-weight-bold"><?php echo count($bidan) ?></div>
                            <br>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-lg "></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 mb-4">
        <a href="#" class="text-decoration-none">
            <div class="card border-success shadow h-100 py-2">
                <div class="card-body text-success">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class=" text-xs font-weight-bold text-uppercase mb-1">
                                transaksi
                            </div>
                            <div class="h5 mb-0 font-weight-bold">-</div>
                            <br>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-clipboard fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>

<?= $this->endSection(); ?>