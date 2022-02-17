<?= $this->include('layout/header') ?>

<body>
    <?= $this->include('bidan/layout/bidan_navbar') ?>

    <header class="bg-light mb-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="h1 my-4"><?= $header; ?></h1>
                </div>
            </div>
        </div>
    </header>

    <div class="content-container">

        <div class="container my-3">
            <div class="row">
                <div class="col-md-12">
                    <?= $this->renderSection('content'); ?>
                </div>
            </div>
        </div>

        <?= $this->include('layout/footer') ?>