<?= $this->include('layout/header') ?>

<body>
    <?= $this->include('layout/navbar') ?>

    <?= $this->renderSection('content'); ?>

    <?= $this->include('layout/footer') ?>