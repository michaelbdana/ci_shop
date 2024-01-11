<?= $this->extend('layouts/backend/dashboard') ?>

<?= $this->section('content') ?>

<h2 class="text-secondary mt-5"><?= esc($page_name) ?></h2>

<ul id="tabs" class="nav nav-tabs">
    <li class="nav-item"><a href="" data-target="#details" data-toggle="tab" class="nav-link text-uppercase active">Details</a></li>
    <li class="nav-item"><a href="" data-target="#variants" data-toggle="tab" class="nav-link text-uppercase">Variants</a></li>
    <li class="nav-item"><a href="" data-target="#attributes" data-toggle="tab" class="nav-link text-uppercase">Attributes</a></li>
</ul>
<br>

<div id="tabsContent" class="tab-content">

    <div id="details" class="tab-pane fade active show">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <?= form_open_multipart(url_to('products.add')) ?>

            <input type="hidden" name="_method" value="put">


            <div class="card card-body">
                <div class="form-group col-lg-6 col-md-12">
                    <label>Product Name <span class="text-danger">*</span></label>
                    <input value="<?= set_value('name') ?>" name="name" type="text" class="form-control <?php if ($validation->hasError('name')) { echo 'is-invalid'; }?>" required>
                    <small>The name of your product. This will be shown on the product page.</small>
                    <?php if ($validation->hasError('name')) { ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('name') ?>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="card card-body">
                <div class="form-group col-12">
                    <label>Product Description</label>
                    <textarea id="description" name="description"><?= set_value('description') ?></textarea>
                    <small>A short description or blurb that describes your product. This will be shown on the product page.</small>
                </div>
            </div>

            <div class="card card-body">
                <div class="form-group col-lg-6 col-md-12">
                    <label class="mr-5">Is this product currently on sale?</label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="on_sale" value="1" <?php if (set_value('on_sale') == 1) { echo 'checked'; } ?>>
                        <span class="custom-control-label">Yes</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="on_sale" value="0" <?php if (set_value('on_sale') == 0) { echo 'checked'; } ?>>
                        <span class="custom-control-label">No</span>
                    </label>
                </div>
            </div>

            <div class="card card-body">
                <div class="row form-group">
                    <div class=" col-lg-4 col-md-12">
                        <label>Product Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/png, image/gif, image/jpeg" onchange="loadFile(event)" class="<?php if ($validation->hasError('name')) { echo 'is-invalid'; }?>">
                        <?php if ($validation->hasError('image')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('image') ?>
                        </div>
                        <?php } ?>
                    </div>

                    <div class=" col-lg-6 col-md-12">
                        <img id="dispimg" src="<?= base_url('uploads/'.set_value('image')) ?>" height="150px" style="<?php if (empty($product['image'])) { echo 'display:none;'; } ?>" />
                        <script>
                        var loadFile = function(event) {
                            var output = document.getElementById('dispimg');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.style.display = "block";
                            output.onload = function() {
                                URL.revokeObjectURL(output.src) // free memory
                            }
                        };
                        </script>
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-outline-success mr-3">Update</button>
                <a href="<?= url_to('products') ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
            <?= form_close() ?>
        </div>
    </div>

    <div id="variants" class="tab-pane fade">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <a href="#" class="" data-toggle="collapse" data-target="#collapseVariants" aria-expanded="true" aria-controls="collapseVariants">
                            Variants <i class="fa fa-chevron-down"></i>
                        </a>
                        <small class="ml-5">
                            <i class="fas fa-question-circle" data-toggle='tooltip' data-placement='top' title='Variants allow different versions of a product like different colors or different formats. You must have at least 1 variant.'></i>
                        </small>
                    </h5>
                </div>

                <div id="collapseVariants" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-4">
                                <label>Variant Name <span class="text-danger">*</span></label>
                                <input value="" name="variant-name" type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <label>Variant Price</label>
                                <input value="0.00" name="variant-price" type="text" class="form-control">
                            </div>
                            <div class="col-4 mt-4">
                                <label>Is Variant Free?</label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="variant-free" value="1">
                                    <span class="custom-control-label">Yes</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="variant-free" value="0">
                                    <span class="custom-control-label">No</span>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <label>Variant Weight</label>
                                <input value="0.00" name="variant-weight" type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <label>Variant Height</label>
                                <input value="0.00" name="variant-height" type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <label>Variant Width</label>
                                <input value="0.00" name="variant-width" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-2">
                                <a href="#" class="btn btn-outline-primary btn-sm">Add Variant</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="attributes" class="tab-pane fade">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        hello
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('extra_header_stuff') ?>
<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/y37ebnzbqvhde9muip8no3utg11nvn20hcoczkwkllnfcesw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
tinymce.init({
    selector: 'textarea',
    branding: false
});

</script>

<?= $this->endSection() ?>