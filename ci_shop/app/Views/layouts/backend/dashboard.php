<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= env('app.Name') ?> | <?= esc($page_name) ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/concept/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link href="<?= base_url('assets/concept/vendor/fonts/circular-std/style.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/concept/libs/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/concept/vendor/fonts/fontawesome/css/fontawesome-all.css') ?>">
    <script src="<?= base_url('assets/concept/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
    <?= csrf_meta() ?>
    <?= $this->renderSection('extra_header_stuff') ?>

</head>

<body>

    <!-- Page Wrapper -->
    <div id="dashboard-main-wrapper">

        <?= $this->include('layouts/backend/topbar.php') ?>
        <?= $this->include('layouts/backend/sidebar.php') ?>

        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">

                    <?= $this->include('layouts/backend/flash.php') ?>
                    <?= $this->renderSection('content') ?>

                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; BelongBooks.com 2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <script src="<?= base_url('assets/concept/vendor/bootstrap/js/bootstrap.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/concept/vendor/slimscroll/jquery.slimscroll.js') ?>"></script>
    <script src="<?= base_url('assets/concept/libs/js/main-js.js') ?>"></script>

    <?= $this->renderSection('extra_footer_stuff') ?>
</body>
</html>