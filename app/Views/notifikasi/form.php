<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>
<!-- <link href="<?php //echo base_url('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css'); 
                    ?>" rel="stylesheet"> -->
<link href="<?= base_url('vendors/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">
<style>
    .bsubmit {
        display: inline-block;
        padding: 9px 15px;
        font-size: 15px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #304FFD;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px #999;
    }

    .bsubmit:hover {
        background-color: #304FFD
    }

    .bsubmit:active {
        background-color: #304FFD;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
</style>
<link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>">
<div class="card m-2">
    <br>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h6>Jenis Peraturan</h6>
                        <select name="" class="form-control" style="border-radius: 13px;" id="">
                            <option value="">- Pilih -</option>
                            <option value="">Alat 1</option>
                            <option value="">Alat 2</option>
                            <option value="">Alat 3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h6>No Peraturan</h6>
                        <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>Judul</h6>
                        <input type="text" class="form-control" style="border-radius: 13px;" name="" />
                    </div>
                    <br>
                    <h6>Bagian Yang Relevan</h6><br>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <h6>BAB</h6>
                        <input type="text" name="" id="" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <h6>Pasal</h6>
                        <input type="text" name="" id="" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <h6>AYAT</h6>
                        <input type="text" name="" id="" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>Tentang</h6>
                        <textarea class="form-control" style="border-radius: 13px;" name="" id="" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <h6>Implementasi</h6>
                    <br>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h6>Fasilitas</h6>
                        <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h6>Dokumen Kerja</h6>
                        <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>Status Pemenuhan</h6>
                        <select name="" class="form-control" style="border-radius: 13px;" id="">
                            <option value="">- Pilih -</option>
                            <option value="">Status 1</option>
                            <option value="">Status 2</option>
                            <option value="">Status 3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>Keterangan</h6>
                        <textarea class="form-control" style="border-radius: 13px;" name="" id="" rows="3"></textarea>
                    </div>
                    <br>
                </div>
            </div>

            <br><br>
            <div class="form-group">
                <center><button class="bsubmit">Submit</button></center>
            </div>
            <br><br>
        </div>
    </div>

</div>

<script src="<?= base_url('assets/vendors/jquery/js/jquery.slim.min.js') ?>"></script>
<script src="<?= base_url('assest/vendors/datatables.net/js/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/datatables.js') ?>"></script>

<!-- /.card-->
<?= $this->endSection(); ?>