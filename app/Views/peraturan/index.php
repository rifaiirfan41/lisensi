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
                        <th rowspan="2" style="width: 5%;">No</th>
                        <th rowspan="2" style="width: 15%;">NO PERATURAN</th>
                        <th rowspan="2" style="width: 10%;">JUDUL</th>
                        <th colspan="3" style="width: 15%;">BAGIAN YANG RELEVAN</th>
                        <th rowspan="2" style="width: 15%;">DESKRIPSI</th>
                        <th colspan="2" style="width: 20%;">IMPLEMENTASI</th>
                        <th colspan="3" style="width: 10%;">STATUS PEMENUHAN</th>
                        <th rowspan="2" style="width: 10%;">KETERANGAN</th>
                        <th rowspan="2" style="width: 10%;">Aksi</th>
                        <th rowspan="2" style="width: 10%;">Ket</th>
                    </tr>
                    <tr class="text-center" style="font-size: 12px;">
                        <th>BAB</th>
                        <th>PASAL</th>
                        <th>AYAT</th>
                        <th>FASILITAS</th>
                        <th>DOK KERJA</th>
                        <th>SUDAH</th>
                        <th>PROSES</th>
                        <th>BELUM</th>
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
                    <div class="col-md-12">
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
                                <div class="form-group">
                                    <label class="col-md-2 col-form-label">PASAL</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="peraturanpasal" id="peraturanpasal" placeholder="Pasal">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-2 col-form-label">AYAT</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="peraturanayat" id="peraturanayat" placeholder="Ayat">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">Deskripsi</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="peraturandeskripsi" id="peraturandeskripsi" placeholder="Deskripsi " id="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">Fasilitas</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="peraturanfasilitas" id="peraturanfasilitas" placeholder="Deskripsi " id="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">Dokumen Kerja</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="peraturandokkerja" id="peraturandokkerja" placeholder="Instansi" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="col-md-12 col-form-label"> Status Pemenuhan</label>
                                        <div class="col-md-12">
                                            <select name="peraturanstatus" id="peraturanstatus" class="form-control" style="border-radius: 13px;" id="status">
                                                <option value="">- Pilih -</option>
                                                <option value="Sudah">Sudah</option>
                                                <option value="Proses">Proses</option>
                                                <option value="Belum">Belum</option>
                                            </select>
                                            <div class="invalid-feedback status"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">Keterangan</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="peraturanketerangan" id="peraturanketerangan" placeholder="Notes" id="">
                                    </div>
                                </div>
                            </div>


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
    // function format(d) {
    //     // `d` is the original data object for the row
    //     return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
    //         '<tr>' +
    //         '<td>:</td>' +
    //         '<td>' + d.no + '</td>' +
    //         '</table>';
    // }
    $(document).ready(function() {
        var table = $('#tabeldata').DataTable({
            "order": [],
            "processing": true,
            "serverSide": true,
            "destroy": true,
            // "retrieve": true,
            // "paging": false,
            "ajax": {
                "url": "<?php echo site_url('peraturan/ajax_list'); ?>",
                "type": "POST"
            },
            "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                },
                {
                    "targets": [-1],
                    visible: false
                }

            ],
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(14, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr style="background: grey; color:white;"><td colspan="14">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        table.rows().every(function() {
            this.child('Row details for row: ' + this.index());
        });

        $('#tabledata tbody').on('click', 'tr', function() {
            var child = table.row(this).child;

            if (child.isShown()) {
                child.hide();
            } else {
                child.show();
            }
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

            // $('[name="peraturanbab"]').val(peraturanbab);
            // $('[name="peraturanpasal"]').val(peraturanpasal);
            // $('[name="peraturanayat"]').val(peraturanayat);
            // $('[name="peraturandeskripsi"]').val(peraturandeskripsi);
            // $('[name="peraturanfasilitas"]').val(peraturanfasilitas);
            // $('[name="peraturandokkerja"]').val(peraturandokkerja);
            // $('[name="peraturanstatus"]').val(peraturanstatus);
            // $('[name="peraturanketerangan"]').val(peraturanketerangan);
            $('[name="peraturanid"]').val(id);

        });
        $('#btn_update').on('click', function() {
            $('#btn_update').prop('disabled', true);
            $('#btn_update').html('Menyimpan...');
            var id = $('[name="peraturanid"]').val();
            var bab = $('[name="peraturanbab"]').val();
            // var jenisid = $('#perizinan_jenisid').val();
            var pasal = $('[name="peraturanpasal"]').val();
            var ayat = $('[name="peraturanayat"]').val();
            var deskripsi = $('[name="peraturandeskripsi"]').val();
            var fasilitas = $('[name="peraturanfasilitas"]').val();
            var dokkerja = $('[name="peraturandokkerja"]').val();
            var status = $('[name="peraturanstatus"]').val();
            var keterangan = $('[name="peraturanketerangan"]').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('peraturan/ajax_tambahrelavan') ?>",
                dataType: "JSON",
                data: {
                    idPeraturan: id,
                    bab: bab,
                    pasal: pasal,
                    ayat: ayat,
                    tentang: deskripsi,
                    fasilitas: fasilitas,
                    dokumenKerja: dokkerja,
                    statusPemenuhan: status,
                    keterangan: keterangan
                },
                success: function(data) {
                    console.log(data);
                    $('[name="perizinan_id_edit"]').val("");
                    $('[name="perizinan_jenisid_edit"]').val("");
                    $('[name="perizinan_noperizinan_edit"]').val("");
                    reload_table();
                    $('#Modal_Tambah').modal('toggle');
                    $('#btn_update').html('Submit');
                    $('#btn_update').prop('disabled', false);

                    Swal.fire({
                        icon: 'success',
                        width: 300,
                        height: 300,
                        text: 'Data berhasil ditambahkan',
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
    $('.bgn').fadeOut('slow');
</script>
<!-- /.card-->
<?= $this->endSection(); ?>