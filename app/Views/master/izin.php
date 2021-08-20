<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>

<link href="<?= base_url('vendors/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>">
<div class="card m-2">
    <br>
    <div class="float-right m-2">
        <a class="btn btn-md btn-primary mfe-1 float-right rounded-pill" data-target="#tambah" data-toggle="modal" style="width: 100px;" href="#">
            Add
        </a>
    </div>
    <!-- </div> -->
    <div class="card-body table-responsive">
        <div class=" justify-content-between">
            <table class="table table-striped table-sm table-bordered datatable" style="font-size:12px;" id="tabeldata">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 20%;">TIMESTAMP</th>
                        <th style="width: 20%;">JENIS PERIZINAN</th>
                        <th style="width: 35%;">TENTANG</th>
                        <th style="width: 15%;">ACTION</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                </tbody>
            </table>
        </div>

        <!-- MODAL EDIT -->
        <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Perizinan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col">
                                <label class="col-md-12 col-form-label">Jenis Perizinan</label>
                                <div class="col-md-12">
                                    <input type="hidden" name="jenis_id_edit" id="jenis_id_edit">
                                    <input type="text" name="jenis_nama_edit" id="jenis_nama_edit" class="form-control" placeholder="Jenis Perizinan">
                                </div>
                            </div>
                            <div class="form-group col">
                                <label class="col-md-12 col-form-label">Deskripsi</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="jenis_deskripsi_edit" id="jenis_deskripsi_edit" placeholder="Deskripsi " id="" cols="30" rows="10"></textarea>
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
        <!-- Modal tambah -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jenis Perizinan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="javascript:void(0)" name="ajax_form" id="ajax_form" method="post" accept-charset="utf-8">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Jenis Perizinan</label>
                                <input type="text" name="nama" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <label>Tentang</label>
                                <textarea name="deskripsi" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" id="send_form" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="<?= base_url('assets/vendors/jquery/js/jquery.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script src="<?= base_url('assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#show_data').on('click', '.item_edit', function() {
            var namaJenis = $(this).data('jenis_nama');
            var deskripsi = $(this).data('jenis_deskripsi');
            var jenisid = $(this).data('jenis_id');
            // var price = $(this).data('price');idJenisIzin

            $('#Modal_Edit').modal('show');
            $('[name="jenis_nama_edit"]').val(namaJenis);
            $('[name="jenis_deskripsi_edit"]').val(deskripsi);
            $('[name="jenis_id_edit"]').val(jenisid);
            // $('[name="price_edit"]').val(price);
        });
        $('#btn_update').on('click', function() {
            $('#btn_update').prop('disabled', true);
            $('#btn_update').html('Menyimpan...');
            var jenis_id = $('#jenis_id_edit').val();
            var jenis_nama = $('#jenis_nama_edit').val();
            var jenis_deskripsi = $('#jenis_deskripsi_edit').val();
            // var price = $('#price_edit').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('master/ajax_editizin') ?>",
                dataType: "JSON",
                data: {
                    jenis_id: jenis_id,
                    jenis_nama: jenis_nama,
                    jenis_deskripsi: jenis_deskripsi
                },
                success: function(data) {
                    $('[name="jenis_id_edit"]').val("");
                    $('[name="jenis_nama_edit"]').val("");
                    $('[name="jenis_deskripsi_edit"]').val("");
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

    if ($("#ajax_form").length > 0) {
        $("#ajax_form").validate({

            rules: {
                nama: {
                    required: true,
                },

                deskripsi: {
                    required: true,
                },
            },
            messages: {

                nama: {
                    required: "<p style='color:red'>Wajib mengisi jenis perizinan</p>",
                },
                deskripsi: {
                    required: "<p style='color:red'>Wajib mengisi tentang jenis perizinan</p>",
                },

            },
            submitHandler: function(form) {
                $('#send_form').prop('disabled', true);
                $('#send_form').html('Menyimpan...');
                $.ajax({
                    url: "<?php echo base_url('master/t_izin') ?>",
                    type: "POST",
                    data: $('#ajax_form').serialize(),
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        console.log(response.success);
                        $('#send_form').html('Submit');
                        $('#res_message').html(response.msg);
                        $('#res_message').show();
                        $('#res_message').removeClass('d-none');

                        document.getElementById("ajax_form").reset();
                        setTimeout(function() {
                            $('#res_message').hide();
                            $('#res_message').html('');
                        }, 10000);
                        $('#tambah').modal('toggle');
                        reload_table();
                        $('#send_form').prop('disabled', false);

                        Swal.fire({
                            icon: 'success',
                            width: 300,
                            height: 300,
                            text: 'Data berhasil ditambahkan',
                            background: 'linear-gradient(90deg, rgba(214,222,255,0.9724264705882353) 0%, rgba(176,201,255,0.9668242296918768) 100%);',
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }
                });
            }
        })
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        table = $('#tabeldata').DataTable({
            "order": [],
            "processing": true,
            "serverSide": true,
            "destroy": true,
            // "retrieve": true,
            // "paging": false,
            "ajax": {
                "url": "<?php echo site_url('master/ajax_izin'); ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false
            }]
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
                    url: "<?php echo site_url('master/delete_izin') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Data berhasil dihapus',
                            showConfirmButton: false,
                            width: 200,
                            height: 200,
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
    $('.bgn').fadeOut('slow');
</script>
<!-- /.card-->
<?= $this->endSection(); ?>