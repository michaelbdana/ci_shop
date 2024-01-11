
<?php if (!empty(session()->getFlashdata('success'))) { ?>
<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
<?php 
    $s = "";
    $d = session()->getFlashdata('success');
    if (is_array($d)) {
       foreach ($d as $k => $v) {
            $s .= '['.$k.']: '.$v.'<br/>';
       } 
    } else {
        $s = $d;
    }
  ?>
  <strong><?= $s ?></strong>
    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </a>
</div>
<?php } ?>

<?php if (!empty(session()->getFlashdata('error'))) { ?>
<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
  <?php 
    $s = "";
    $d = session()->getFlashdata('error');
    if (is_array($d)) {
       foreach ($d as $k => $v) {
            $s .= '['.$k.']: '.$v.'<br/>';
       } 
    } else {
        $s = $d;
    }
  ?>
  <strong><?= $s ?></strong>
  <a href="#" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </a>
</div>
<?php } ?>

<?php if (!empty(session()->getFlashdata('warning'))) { ?>
<div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
<?php 
    $s = "";
    $d = session()->getFlashdata('warning');
    if (is_array($d)) {
       foreach ($d as $k => $v) {
            $s .= '['.$k.']: '.$v.'<br/>';
       } 
    } else {
        $s = $d;
    }
  ?>
  <strong><?= $s ?></strong>
  <a href="#" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </a>
</div>
<?php } ?>

<?php if (!empty(session()->getFlashdata('info'))) { ?>
<div class="alert alert-info alert-dismissible fade show mt-5" role="alert">
<?php 
    $s = "";
    $d = session()->getFlashdata('info');
    if (is_array($d)) {
       foreach ($d as $k => $v) {
            $s .= '['.$k.']: '.$v.'<br/>';
       } 
    } else {
        $s = $d;
    }
  ?>
  <strong><?= $s ?></strong>  <a href="#" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </a>
</div>
<?php } ?>