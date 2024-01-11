<?= $this->extend('layouts/backend/dashboard.php') ?>

<?= $this->section('page_heading') ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= esc($page_name) ?></h1>
    </div>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
    <div class="container-fluid">

        <?= $this->renderSection('page_heading') ?>

        <div class="row">
            <h1>Auth ID is <?= $user_id ?></h1>
        </div>

    </div>
<?= $this->endSection() ?>