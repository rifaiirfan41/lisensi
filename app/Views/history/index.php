<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>

<link href="<?= base_url('assets/vendors/select2/css/select2.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendors/select2/css/select2-coreui.min.css') ?>" rel="stylesheet">
<!-- <link href="<?php //echo base_url('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css'); 
                    ?>" rel="stylesheet"> -->
<link href="<?= base_url('vendors/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">
<!-- <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<div class="card m-2">

    <!-- <div class="form-group"> -->
    <div class="card-header d-flex align-items-center m-2">
        <div class="form-group">
            <input type="date" name="" id="input" class="form-control" value="" required="required" title="">
        </div>

        <div class="mfs-auto mfe-1 d-print-none" href="#" style="border-radius: 13px">
            <select name="" class="form-control" id="">
                <option value="">Filter Status</option>
                <option value="">Filter Status</option>
                <option value="">Filter Status</option>
            </select>
        </div>
        <a class="btn btn-md btn-primary mfe-1 d-print-none rounded-pill" style="width: 110px;" href="#">
            Export
        </a>
    </div>
    <!-- </div> -->
    <div class="card-body">
        <div class=" justify-content-between table-responsive">
            <table class="table table-sm table-striped table-bordered datatable" id="tabeldata">
                <thead style="font-size:12px;">
                    <tr>
                        <th rowspan="2" style="width: 10%;">No</th>
                        <th rowspan="2" style="width: 15%;">Aktivitas</th>
                        <th colspan="4" style="width: 30%;">Perizinan</th>
                        <th colspan="2" style="width: 15%;">Dikeluarkan Oleh</th>
                        <th rowspan="2" style="width: 10%;">Tanggal Aktif</th>
                        <th rowspan="2" style="width: 10%;">Tanggal Berlaku</th>
                        <th rowspan="2" style="width: 10%;">Action</th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. Perijinan</th>
                        <th>Deskripsi</th>
                        <th>Instance Name</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <form>
        <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Perizinan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Jenis Perizinan</label>
                            <div class="col-md-10">
                                <input type="hidden" name="perizinan_id_edit" id="perizinan_id_edit">
                                <!-- <input type="text" name="perizinan_jenisid_edit" id="perizinan_jenisid_edit" class="form-control" placeholder="Jenis Perizinan"> -->
                                <select class="form-control" id="perizinan_jenisid_edit" id="perizinan_jenisid_edit" name="perizinan">
                                    <option></option>
                                    <?php foreach ($data as $key => $v) { ?>
                                        <option value="<?= $v['idJenisIzin'] ?>"><?= $v['namaJenis'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">No Perizinan</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="perizinan_noperizinan_edit" id="perizinan_noperizinan_edit" placeholder="No perizinan ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="perizinan_namap_edit" id="perizinan_namap_edit" placeholder="Nama ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Deskripsi</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="perizinan_tdeskripsi_edit" id="perizinan_tdeskripsi_edit" placeholder="Deskripsi " id="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Tanggal Aktif</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="perizinan_tdeskripsi_edit" id="perizinan_tdeskripsi_edit" placeholder="Deskripsi " id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Tanggal Berlaku</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="perizinan_tdeskripsi_edit" id="perizinan_tdeskripsi_edit" placeholder="Deskripsi " id="">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btn_update" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--END MODAL EDIT-->
</div>
<script src="<?= base_url('assets/vendors/jquery/js/jquery.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="<?= base_url('assets/vendors/select2/js/select2.min.js'); ?>"></script>


<script type="text/javascript">
    $('#perizinan_jenisid_edit').select2({
        theme: 'coreui',
        placeholder: '- Pilih Lokasi -',
        allowClear: true,
    });
    $(document).ready(function() {
        $('#show_data').on('click', '.item_edit', function() {
            var id = $(this).data('perizinan_id');
            var noperizinan = $(this).data('perizinan_noperizinan');
            var jenisid = $(this).data('perizinan_jenisid');
            // var price = $(this).data('price');idJenisIzin

            $('#Modal_Edit').modal('show');
            // $('[name="perizinan_jenisid_edit"]').val(jenisid);
            var opt = document.getElementById('perizinan_jenisid_edit').options[0];
            opt.value = 'box';
            opt.text = 'box';
            console.log(jenisid);
            $('[name="perizinan_noperizinan_edit"]').val(noperizinan);
            $('[name="perizinan_id_edit"]').val(id);
            // $('[name="price_edit"]').val(price);
        });
        $('#btn_update').on('click', function() {
            $('#btn_update').prop('disabled', true);
            $('#btn_update').html('Menyimpan...');
            var jenis_id = $('#perizinan_id_edit').val();
            var jenis_nama = $('#perizinan_jenisid_edit').val();
            var perizinan_noperizinan = $('#perizinan_noperizinan_edit').val();
            // var price = $('#price_edit').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Listdataperizinan/ajax_editizin') ?>",
                dataType: "JSON",
                data: {
                    perizinan_id: perizinan_id,
                    perizinan_jenisid: perizinan_jenisid,
                    perizinan_noperizinan: perizinan_noperizinan
                },
                success: function(data) {
                    $('[name="perizinan_id_edit"]').val("");
                    $('[name="perizinan_jenisid_edit"]').val("");
                    $('[name="perizinan_noperizinan_edit"]').val("");
                    reload_table();
                    $('#Modal_Edit').modal('toggle');
                    $('#btn_update').html('Submit');
                    $('#btn_update').prop('disabled', false);

                    Swal.fire({
                        icon: 'success',
                        width: 300,
                        height: 300,
                        text: 'Data berhasil diubah',
                        background: 'linear-gradient(90deg, rgba(214,222,255,0.9724264705882353) 0%, rgba(176,201,255,0.9668242296918768) 100%);',
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
            });
            return false;
        });



    });
    $(document).ready(function() {
        table = $('#tabeldata').DataTable({
            // "order": [],
            "processing": true,
            "serverSide": true,
            "destroy": true,
            // "retrieve": true,
            // "paging": false,
            "ajax": {
                "url": "<?php echo site_url('history/ajax_list'); ?>",
                "type": "POST"
            },
            "order": [
                [1, 'asc']
            ],
            "columnDefs": [{
                // "targets": [0],
                "orderable": false,
                "visible": false,
                "targets": 2
            }],
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(1, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr style="background: grey; color:white;"><td colspan="10">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
    });


    function reload_table() {
        table.ajax.reload(null, false);
    }

    function delete_data(id) {
        swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data akan hilang setelah dihapus!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Iya'
        }).then((result) => {
            if (result.value) {
                // ajax delete data to database
                $.ajax({
                    url: "<?php echo site_url('history/delete_izin') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Data berhasil dihapus',
                            showConfirmButton: false,
                            width: 300,
                            height: 300,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        //if success reload ajax table
                        // $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection(); ?>