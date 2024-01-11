<?= $this->extend('layouts/backend/dashboard') ?>


<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <?= form_open('/admin/user/edit/'.$user->id) ?>
            <input type="hidden" name="_method" value="patch">
        <div class="card">
            <h5 class="card-header">Edit User</h6>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="form-group col-6">
                                <label>ID <span class="text-danger">*</span></label>
                                <input value="<?= $user->id ?>" name="id" type="text" class="form-control <?php if ($validation->hasError('id')) { echo 'is-invalid'; }?>" disabled>
                                <?php if ($validation->hasError('id')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('id') ?>
                                </div>
                                <?php } ?>
                        </div>
                        <div class="form-group col-6">
                                <label>User Name <span class="text-danger">*</span></label>
                                <input value="<?= $user->username ?>" name="username" type="text" class="form-control <?php if ($validation->hasError('username')) { echo 'is-invalid'; }?>" required>
                                <small>The user name for this user.</small>
                                <?php if ($validation->hasError('username')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username') ?>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-6">
                                <label>Status</label>
                                <input value="<?= $user->status ?>" name="status" type="text" class="form-control <?php if ($validation->hasError('status')) { echo 'is-invalid'; }?>" >
                                <small>Active, Suspended</small>
                                <?php if ($validation->hasError('status')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('status') ?>
                                </div>
                                <?php } ?>
                        </div>
                        <div class="form-group col-6">
                                <label>Status Message </label>
                                <input value="<?= $user->status_message ?>" name="status_message" type="text" class="form-control <?php if ($validation->hasError('status_message')) { echo 'is-invalid'; }?>" >
                                <small>A quick reason for the status.</small>
                                <?php if ($validation->hasError('status_message')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('status_message') ?>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-6">
                                <label>Active</label>
                                <input value="<?= $user->active ?>" name="active" type="text" class="form-control <?php if ($validation->hasError('active')) { echo 'is-invalid'; }?>" >
                                <small>Boolean 1=yes, 0=no</small>
                                <?php if ($validation->hasError('active')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('active') ?>
                                </div>
                                <?php } ?>
                        </div>
                        <div class="form-group col-6">
                                <label>Last Active </label>
                                <input value="<?= $user->last_active ?>" name="last_active" type="text" class="form-control <?php if ($validation->hasError('last_active')) { echo 'is-invalid'; }?>" disabled>
                                <?php if ($validation->hasError('last_active')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('last_active') ?>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-4">
                                <label>Created At</label>
                                <input value="<?= $user->created_at ?>" name="created_at" type="text" class="form-control <?php if ($validation->hasError('created_at')) { echo 'is-invalid'; }?>" disabled>
                                <?php if ($validation->hasError('created_at')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('created_at') ?>
                                </div>
                                <?php } ?>
                        </div>
                        <div class="form-group col-4">
                                <label>Updated At </label>
                                <input value="<?= $user->updated_at ?>" name="updated_at" type="text" class="form-control <?php if ($validation->hasError('updated_at')) { echo 'is-invalid'; }?>" disabled>
                                <?php if ($validation->hasError('updated_at')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('updated_at') ?>
                                </div>
                                <?php } ?>
                        </div>
                        <div class="form-group col-4">
                                <label>Deleted At </label>
                                <input value="<?= $user->deleted_at ?>" name="deleted_at" type="text" class="form-control <?php if ($validation->hasError('deleted_at')) { echo 'is-invalid'; }?>" disabled>
                                <?php if ($validation->hasError('deleted_at')) { ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('deleted_at') ?>
                                </div>
                                <?php } ?>
                        </div>
                    </div>

                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success mr-3">Update</button>
                    <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-secondary">Cancel</a>
                </div>

            </div>
        <?= form_close() ?>
    </div>
</div>
<?= $this->endSection() ?>