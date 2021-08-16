<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>
<!-- <link href="<?php //echo base_url('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css'); 
                    ?>" rel="stylesheet"> -->

<link href="<?= base_url('assets/vendors/select2/css/select2.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendors/select2/css/select2-coreui.min.css') ?>" rel="stylesheet">
<div class="card m-2">
    <br>
    <!-- <div class="form-group"> -->
    <div class="float-right m-2">
        <a class="btn btn-md btn-primary mfe-1 float-right rounded-pill" style="width: 100px;" href="#" data-toggle="modal" data-target="#tambah">
            Add
        </a>
    </div>
    <!-- </div> -->
    <div class="card-body">
        <div class=" justify-content-between">
            <table class="table table-sm nowrap table-striped table-bordered datatable" id="tabeldata">
                <thead style="font-size:12px;">
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 15%;">TIMESTAMP</th>
                        <th style="width: 30%;">NAMA PERALATAN</th>
                        <th style="width: 30%;">DETAIL</th>
                        <th style="width: 15%;">ACTION</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                </tbody>
            </table>
        </div>

        <!-- MODAL EDIT -->
        <!-- <form> -->
        <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Peralatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="javascript:void(0)" name="ajax_edit" id="ajax_edit" method="post" accept-charset="utf-8">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="peralatan_id_edit" id="peralatan_id_edit">
                                <label for="">Nama Peralatan</label>
                                <input type="text" name="peralatan_nama_edit" id="peralatan_nama_edit" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <label for="">Detail</label>
                                <textarea name="peralatan_detail_edit" class="form-control" id="peralatan_detail_edit" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btn_update" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- </form> -->
        <!--END MODAL EDIT-->

        <!-- Modal -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Peralatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="javascript:void(0)" name="ajax_form" id="ajax_form" method="post" accept-charset="utf-8">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Peralatan</label>
                                <input type="text" name="namaPeralatan" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <label for="">Detail</label>
                                <textarea name="detail" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="send_form" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
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

<script src="<?= base_url('assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/moment/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/select2/js/select2.min.js'); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#lokasi').select2({
            theme: 'coreui',
            placeholder: '- Pilih Lokasi -',
            allowClear: true
        });
    })
</script>
<script>
    $(document).ready(function() {
        $('#show_data').on('click', '.item_edit', function() {
            var nama = $(this).data('peralatan_nama');
            var detail = $(this).data('peralatan_detail');
            var alatid = $(this).data('peralatan_id');
            $('#Modal_Edit').modal('show');
            $('[name="peralatan_nama_edit"]').val(nama);
            $('[name="peralatan_detail_edit"]').val(detail);
            $('[name="peralatan_id_edit"]').val(alatid);
        });
        // $("#ajax_edit").validate({

        //     rules: {
        //         peralatan_nama_edit: {
        //             required: true,
        //         },
        //     },
        //     messages: {

        //         peralatan_nama_edit: {
        //             required: "<p style='color:red'>Wajib mengisi nama peralatan</p>",
        //         },
        //     },
        // });
        $('#btn_update').on('click', function() {
            // $("#ajax_edit").valid();
            $('#btn_update').prop('disabled', true);
            $('#btn_update').html('Menyimpan...');
            var peralatan_id = $('#peralatan_id_edit').val();
            var peralatan_nama = $('#peralatan_nama_edit').val();
            var peralatan_detail = $('#peralatan_detail_edit').val();
            // var price = $('#price_edit').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('master/ajax_editalat') ?>",
                dataType: "JSON",
                data: {
                    peralatan_id: peralatan_id,
                    peralatan_nama: peralatan_nama,
                    peralatan_detail: peralatan_detail
                },
                success: function(data) {
                    $('[name="peralatan_id_edit"]').val("");
                    $('[name="peralatan_nama_edit"]').val("");
                    $('[name="peralatan_detail_edit"]').val("");
                    reload_table();
                    $('#Modal_Edit').modal('toggle');
                    $('#btn_update').html('Submit');
                    $('#btn_update').prop('disabled', false);

                    Swal.fire({
                        icon: 'success',
                        width: 300,
                        text: 'Data berhasil Diubah',
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
                namaPeralatan: {
                    required: true,
                },

                kapasitas: {
                    required: true,
                },
                lokasi: {
                    required: true,
                },
                masaBerlaku: {
                    required: true,
                },
                periodePerpanjangan: {
                    required: true,
                },
            },
            messages: {

                namaPeralatan: {
                    required: "<p style='color:red'>Wajib mengisi nama peralatan</p>",
                },
                kapasitas: {
                    required: "<p style='color:red'>Wajib mengisi kapasitas</p>",
                },
                lokasi: {
                    required: "<p style='color:red'>Wajib mengisi lokasi</p>",
                },
                masaBerlaku: {
                    required: "<p style='color:red'>Wajib mengisi tanggal masa berlaku</p>",
                },
                periodePerpanjangan: {
                    required: "<p style='color:red'>Wajib mengisi tanggal periode</p>",
                },


            },
            submitHandler: function(form) {

                $('#send_form').html('Menyimpan...');
                $.ajax({
                    url: "<?php echo base_url('master/t_alat') ?>",
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

                        Swal.fire({
                            icon: 'success',
                            width: 300,
                            text: 'Data berhasil ditambahkan',
                            // background: 'linear-gradient(90deg, rgba(214,222,255,0.9724264705882353) 0%, rgba(176,201,255,0.9668242296918768) 100%);',
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
                "url": "<?php echo site_url('master/alat_list'); ?>",
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
                    url: "<?php echo site_url('master/delete_alat') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            width: 300,
                            height: 300,
                            text: 'Data berhasil dihapus',
                            // background: 'linear-gradient(90deg, rgba(214,222,255,0.9724264705882353) 0%, rgba(176,201,255,0.9668242296918768) 100%);',
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
<!-- /.card-->
<?= $this->endSection(); ?>