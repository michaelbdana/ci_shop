<?= $this->extend('layouts/backend/dashboard.php') ?>

<?= $this->section('content') ?>

    <h2 class="text-secondary mt-5"><?= esc($page_name) ?></h2>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card shadow mb-10" style="width:100%">
                <h5 class="card-header"><?= $page_name ?>
                    <a class="btn btn-outline-primary btn-sm float-right" href="<?= url_to('products.add') ?>">
                    <span>Add New</span>
                </a>
                </h5>
                <div class="card-body">
                        <table class="table table-bordered table-striped" id="dtbl" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Variants</th>
                                    <th>Attributes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dialog -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="message-delete" method="post" action="">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="delete">
            
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="color:red;">Delete Parmanently?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p style="padding-top: 20px;">Are you sure you want to delete this?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-simple">Delete</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra_header_stuff') ?>
    <link rel="stylesheet" href="<?= base_url('assets/concept/vendor/datatables/css/datatables.bootstrap4.css') ?>"> 
    <link rel="stylesheet" href="<?= base_url('assets/concept/vendor/datatables/css/buttons.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/concept/vendor/datatables/css/select.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/concept/vendor/datatables/css/fixedHeader.bootstrap4.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('extra_footer_stuff') ?>
    <script src="<?= base_url('assets/concept/vendor/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/concept/vendor/datatables/js/datatables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/concept/vendor/datatables/js/dataTables.fixedHeader.min.js') ?>"></script>

    <script>
    $(document).ready(function() {
        var table = $('#dtbl').DataTable( {
            "autoWidth": false,
            "language" : {
                "zeroRecords": " "
            },
            "processing": true,
            "serverSide": true,
            "searchDelay": 500,
            "autoWidth": false,
            "ajax": {
                "url": "<?= url_to('products.ajaxtbl') ?>",
                "type": "POST",
                data: function ( d ) {
                    d.<?= csrf_token() ?> = $('meta[name=<?= csrf_token() ?>]').attr("content");
                }
            },
            columns: [
                {"targets": 0, "data":"id", "name":"id", "type": "string", "visible": true, "orderable": true},
                {"targets": 1, "data":"user_id", "name":"user_id", "type": "string", "visible": false, "orderable": false},
                {"targets": 2, "data":"name", "name":"name", "type": "string", "visible": true, "orderable": true},
                {"targets": 3, "data":"variants", "name":"variants", "type": "string", "visible": true, "orderable": false},
                {"targets": 4, "data":"attributes", "name":"attributes", "type": "string", "visible": true, "orderable": false},
                {"targets": 5, "data":"actions", "name":"actions", "type": "string", "visible": true, "orderable": false}
            ],
            'select': 'multi',
            'order': [[0, 'asc']]
        } );

        $("body").tooltip({
            selector: '[data-toggle="tooltip"]'
        });
        
        $('#dtbl').on('click', '.warn-delete', function(e){

            var row = $(this).closest('tr');
            var id = row.find("td").eq(0).html();
            
            var name = row.find("td").eq(1).html();
            
            var url = "<?= url_to('products.delete',':id') ?>";
            url = url.replace(':id', id);
            $('form#message-delete').attr('action', url);

            $(document).find('#confirmDelete .modal-body p').text('Are you sure you want to delete the product [ '+name+' ]?');
            $('#confirmDelete').modal('show');
        });
    });

    
    
    </script>

<?= $this->endSection() ?>