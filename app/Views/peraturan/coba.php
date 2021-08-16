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
    <div class="card-body table-responsive">
        <div class=" justify-content-between">
            <table class="table teble-sm table-striped table-bordered datatable" id="tabeldata" style="font-size: 12px;">
                <thead style="font-size: 12px;">
                    <tr class="text-center" style="font-size: 12px;">
                        <th rowspan="2" style="width: 15%;">NO PERATURAN</th>
                        <th colspan="3" style="width: 15%;">BAGIAN YANG RELEVAN</th>
                    </tr>
                    <tr class="text-center" style="font-size: 12px;">
                        <th>BAB</th>
                        <th>PASAL</th>
                        <th>AYAT</th>
                    </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
            </table>
        </div>
    </div>

</div>
<form>
    <div class="modal fade" id="Modal_Tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Bagian yang Relavan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="peraturanid" id="peraturanid">
                    <div class="form-inline col-md-12 p-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-2 col-form-label">BAB</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="peraturanbab" id="peraturanbab" placeholder="Bab">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">PASAL</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="peraturanpasal" id="peraturanpasal" placeholder="Pasal">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">AYAT</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="peraturanayat" id="peraturanayat" placeholder="Ayat">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Deskripsi</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="perizinan_tanggalaktif_edit" id="perizinan_tdeskripsi_edit" placeholder="Deskripsi " id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Fasilitas</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="perizinan_tanggalberlaku_edit" id="perizinan_tdeskripsi_edit" placeholder="Deskripsi " id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Dokumen Kerja</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="perizinan_instansi_edit" id="perizinan_instansi_edit" placeholder="Instansi" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="perizinan_alamat_edit" id="perizinan_alamat_edit" placeholder="Alamat" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Keterangan</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="perizinan_notes_edit" id="perizinan_notes_edit" placeholder="Notes" id="">
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
<script src="<?= base_url('assets/vendors/jquery/js/jquery.min.js') ?>"></script>

<script>
    function format(d) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>:</td>' +
            '<td>' + d.no + '</td>' +
            '</table>';
    }
    $(document).ready(function() {
        table = $('#tabeldata').DataTable({
            "order": [],
            "processing": true,
            "serverSide": true,
            "destroy": true,
            // "retrieve": true,
            // "paging": false,
            "ajax": {
                "url": "<?php echo site_url('peraturan/ajax_coba'); ?>",
                "type": "POST"
            },
            "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {
                    "data": "name"
                },
                {
                    "data": "name"
                },

            ],
            "order": [
                [1, 'asc']
            ]
        });
    });

    function reload_table() {
        table.ajax.reload(null, false);
    }
    $(document).ready(function() {
        $('#show_data').on('click', '.itemtambah', function() {
            let id = $(this).data('peraturanid');

            $('#Modal_Tambah').modal('show');
            // $('[name="perizinan_jenisid_edit"]').val(jenisid);
            // var opt = document.getElementById('perizinan_jenisid_edit').options[0];
            // opt.value = 'box';
            // opt.text = 'box';

            $('[name="perizinan_noperizinan_edit"]').val(noperizinan);
            $('[name="perizinan_id_edit"]').val(id);
            $('[name="perizinan_tdeskripsi_edit"]').val(deskripsi);
            $('[name="perizinan_namap_edit"]').val(namap);
            $('[name="perizinan_tanggalberlaku_edit"]').val(tanggalberlaku);
            $('[name="perizinan_tanggalaktif_edit"]').val(tanggalaktif);
            $('[name="perizinan_instansi_edit"]').val(instansi);
            $('[name="perizinan_alamat_edit"]').val(alamat);
            $('[name="perizinan_notes_edit"]').val(catatan);
            // $('#perizinan_jenisid_edit').val(jenisid);
            $('#perizinan_jenisid_edit').html(perizinan);
            // $('[name="price_edit"]').val(price);id="perizinan_jenisid_edit"
        });
        $('#btn_update').on('click', function() {
            $('#btn_update').prop('disabled', true);
            $('#btn_update').html('Menyimpan...');
            var id = $('[name="perizinan_id_edit"]').val();
            var noperizinan = $('[name="perizinan_noperizinan_edit"]').val();
            // var jenisid = $('#perizinan_jenisid').val();
            var tanggalberlaku = $('[name="perizinan_tanggalberlaku_edit"]').val();
            var tanggalaktif = $('[name="perizinan_tanggalaktif_edit"]').val();
            var alamat = $('[name="perizinan_alamat_edit"]').val();
            var instansi = $('[name="perizinan_instansi_edit"]').val();
            var namap = $('[name="perizinan_namap_edit"]').val();
            var deskripsi = $('[name="perizinan_tdeskripsi_edit"]').val();
            // var namajenis = $('[name="perizinan_id_edit"]').val();
            var catatan = $('[name="perizinan_notes_edit"]').val();
            // var price = $('#price_edit').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Listdataperizinan/ajax_editizin') ?>",
                dataType: "JSON",
                data: {
                    perizinanid: id,
                    noperizinan: noperizinan,
                    namap: namap,
                    deskripsi: deskripsi,
                    tglaktif: tanggalaktif,
                    tglberlaku: tanggalberlaku,
                    instansi: instansi,
                    alamat: alamat,
                    catatan: catatan
                },
                success: function(data) {
                    console.log(data);
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
                        // background: 'linear-gradient(90deg, rgba(214,222,255,0.9724264705882353) 0%, rgba(176,201,255,0.9668242296918768) 100%);',
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
            });
            return false;
        });



    });

    $(document).ready(function() {
        var element = document.getElementById("sidebar");
        element.classList.remove("c-sidebar-lg-show");
    });
</script>
<!-- /.card-->
<?= $this->endSection(); ?>