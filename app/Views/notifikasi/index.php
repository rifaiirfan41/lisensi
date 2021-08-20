<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>
<!-- <link href="<?php //echo base_url('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css'); 
                    ?>" rel="stylesheet"> -->
<link href="<?= base_url('vendors/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">

<link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>">

<div class="card m-2">
    <br>
    <!-- <div class="form-group"> -->
    <div class="float-right m-2">
        <a class="btn btn-md btn-primary mfe-1 float-right rounded-pill" style="width: 100px;" href="<?= base_url('peraturan/form') ?>">
            Form
        </a>
    </div>
    <!-- </div> -->
    <div class="card-body">
        <div class=" justify-content-between">
            <form action="">
                <div class="form-group">
                    <label>Alarm start</label>
                    <input class="form-control" type="text" name="">
                </div>
                <div class="form-group">
                    <label>Alarm interval</label>
                    <input class="form-control" type="text" name="">
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    // $(window).load(function() {
    // $('.lod').css('visibility', 'hidden');
    // document.getElementById('.lod').style.visibility = "hidden";
    // document.querySelector('.lod').style.visibility = "hidden"
    // $(window).load(function() {
    // });
    // });
    $('.bgn').fadeOut('slow');
</script>
<!-- /.card-->
<?= $this->endSection(); ?>