<?= $this->extend('layout/admin/admin_layout') ?>

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
                                ADMIN
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo count($admins) ?></div>
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
            <div class="card border-success shadow h-100 py-2">
                <div class="card-body text-success">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class=" text-xs font-weight-bold text-uppercase mb-1">
                                BIDAN
                            </div>
                            <div class="h5 mb-0 font-weight-bold"><?php echo count($bidans) ?></div>
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
            <div class="card border-left-primary shadow h-100 py-2 bg-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                KONSUMEN
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?php echo count($konsumens) ?></div>
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
                                TRANSAKSI
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