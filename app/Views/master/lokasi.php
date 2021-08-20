<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>
<div class="card m-2">
    <br>
    <?= \Config\Services::validation()->listErrors(); ?>

    <!-- <span class="d-none alert alert-success mb-3" id="res_message"></span> -->
    <!-- <div class="form-group"> -->
    <div class="float-right m-2">
        <a class="btn btn-md btn-primary mfe-1 float-right rounded-pill" data-toggle="modal" data-target="#tambah" style="width: 100px;" href="#">
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
                        <th style="width: 10%;">TIMESTAMP</th>
                        <th style="width: 30%;">NAMA</th>
                        <th style="width: 35%;">DETAIL LOKASI</th>
                        <th style="width: 15%;">ACTION</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" name="ajax_form" id="ajax_form" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Lokasi</label>
                        <input type="text" name="nama" id="" class="form-control" placeholder="" aria-describedby="helpId" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Tentang Lokasi</label>
                        <textarea name="detail" class="form-control" cols="30" rows="10"></textarea>
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
<!-- MODAL EDIT -->
<form>
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="">Nama Lokasi</label>
                        <input type="hidden" name="lokasi_id_edit" id="lokasi_id_edit">
                        <input type="text" name="lokasi_nama_edit" id="lokasi_nama_edit" class="form-control" placeholder="lokasi nama">
                    </div>
                    <div class="form-group">
                        <label>Detail Lokasi</label>
                        <div class="">
                            <textarea class="form-control" name="lokasi_detail_edit" id="lokasi_detail_edit" placeholder="Deskripsi " id="" cols="30" rows="10"></textarea>
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
<script src="<?= base_url('assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/moment/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/select2/js/select2.min.js'); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#show_data').on('click', '.item_edit', function() {
            var nama = $(this).data('lokasi_nama');
            var detail = $(this).data('lokasi_detail');
            var lokasiid = $(this).data('lokasi_id');
            $('#Modal_Edit').modal('show');
            $('[name="lokasi_nama_edit"]').val(nama);
            $('[name="lokasi_detail_edit"]').val(detail);
            $('[name="lokasi_id_edit"]').val(lokasiid);
        });
        $('#btn_update').on('click', function() {
            $('#btn_update').prop('disabled', true);
            $('#btn_update').html('Menyimpan...');
            var lokasi_id = $('#lokasi_id_edit').val();
            var lokasi_nama = $('#lokasi_nama_edit').val();
            var lokasi_detail = $('#lokasi_detail_edit').val();
            // var price = $('#price_edit').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('master/ajax_editlokasi') ?>",
                dataType: "JSON",
                data: {
                    lokasi_id: lokasi_id,
                    lokasi_nama: lokasi_nama,
                    lokasi_detail: lokasi_detail
                },
                success: function(data) {
                    $('[name="lokasi_id_edit"]').val("");
                    $('[name="lokasi_nama_edit"]').val("");
                    $('[name="lokasi_detail_edit"]').val("");
                    reload_table();
                    $('#Modal_Edit').modal('toggle');
                    $('#btn_update').html('Submit');
                    $('#btn_update').prop('disabled', false);

                    Swal.fire({
                        icon: 'success',
                        width: 300,
                        height: 300,
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
                nama: {
                    required: true,
                },

                detail: {
                    required: true,
                },
            },
            messages: {

                nama: {
                    required: "<p style='color:red'>Wajib mengisi nama lokasi</p>",
                },
                detail: {
                    required: "<p style='color:red'>Wajib mengisi detail lokasi</p>",
                },

            },
            submitHandler: function(form) {
                $('#send_form').html('Menyimpan...');
                $.ajax({
                    url: "<?php echo base_url('master/tl_lokasi') ?>",
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
                "url": "<?php echo site_url('master/ajax_list'); ?>",
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

    function edit_data(id) {
        // save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $.ajax({
            url: "<?php echo site_url('master/ajax_edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);

                $('#nama').val(data.nama);
                $('[name="detail"]').val(data.detail);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text(data.nama); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
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
                    url: "<?php echo site_url('master/ajax_delete') ?>/" + id,
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
    $('.bgn').fadeOut(10000000);
</script>
<!-- /.card-->
<?= $this->endSection(); ?>