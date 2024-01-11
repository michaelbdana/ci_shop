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
        <div class="card shadow mb-10">
            <div class="card-header py-3">
                <a class="btn btn-success btn-sm" href="<?= base_url('users/add') ?>">Create New User</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dtbl" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Status</th>
                                <th>Status Message</th>
                                <th>Active</th>
                                <th>Profile</th>
                                <th>Paypal Info</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>

    </div>
<?= $this->endSection() ?>

<?= $this->section('extra_header_stuff') ?>
    <link rel="stylesheet" href="<?= base_url('assets/backend/vendor/datatables/datatables.bootstrap4.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('extra_footer_stuff') ?>

    <script src="<?= base_url('assets/backend/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/vendor/datatables/datatables.bootstrap4.min.js') ?>"></script>

    <script>
    $(document).ready(function() {
        var table = $('#dtbl').DataTable( {
            "language" : {
                "zeroRecords": " "
            },
            "processing": true,
            "serverSide": true,
            "searchDelay": 500,
            "ajax": {
                "url": "<?= base_url('admin/users/ajaxtbl') ?>",
                "type": "POST",
                data: function ( d ) {
                    d.<?= csrf_token() ?> = $('meta[name=<?= csrf_token() ?>]').attr("content");
                }
            },
            columns: [
                {"targets": 0, "data":"id", "name":"id", "type": "string", "visible": true, "orderable": true},
                {"targets": 1, "data":"username", "name":"username", "type": "string", "visible": true, "orderable": true},
                {"targets": 2, "data":"status", "name":"status", "type": "string", "visible": true, "orderable": true},
                {"targets": 3, "data":"status_message", "name":"status_message", "type": "string", "visible": true, "orderable": false},
                {"targets": 4, "data":"active", "name":"active", "type": "string", "visible": true, "orderable": true},
                {"targets": 5, "data":"profile", "name":"profile", "type": "string", "visible": true, "orderable": false},
                {"targets": 6, "data":"pp_info", "name":"pp_info", "type": "string", "visible": true, "orderable": false},
                {"targets": 7, "data":"roles", "name":"roles", "type": "string", "visible": true, "orderable": false},
                {"targets": 8, "data":"actions", "name":"actions", "type": "string", "visible": true, "orderable": false}
            ],
            'select': 'multi',
            'order': [[0, 'asc']]
        } );

        $("body").tooltip({
            selector: '[data-toggle="tooltip"]'
        });

    });
    </script>

<?= $this->endSection() ?>