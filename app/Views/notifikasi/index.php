<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>
<!-- <link href="<?php //echo base_url('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css'); 
                    ?>" rel="stylesheet"> -->
<link href="<?= base_url('vendors/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/css/preloader.css') ?>" rel="stylesheet">

<link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>">
<div class="loader">
    <div class="inner_loader_1"></div>
    <div class="inner_loader_2"></div>
    <div class="inner_loader_3"></div>
    <div class="inner_loader_4"></div>
    <div class="inner_loader_5"></div>
    <div class="inner_loader_6"></div>
</div>
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

<script src="<?= base_url('assets/vendors/jquery/js/jquery.slim.min.js') ?>"></script>
<script src="<?= base_url('assest/vendors/datatables.net/js/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/datatables.js') ?>"></script>

<!-- /.card-->
<?= $this->endSection(); ?>