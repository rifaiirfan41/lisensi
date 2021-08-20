<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>

<link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>">

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
    <div class="card-body table-responsive">
        <div class=" justify-content-between">
            <table class="table table-sm table-striped table-bordered datatable" id="tabeldata">
                <thead style="font-size:12px;">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 5%;">No Urut Dokumen</th>
                        <th style="width: 10%;">No Dokumen</th>
                        <th style="width: 10%;">No Pengesahan</th>
                        <th style="width: 10%;">Nama Peralatan</th>
                        <th style="width: 10%;">Kapasitas</th>
                        <th style="width: 10%;">Lokasi</th>
                        <th style="width: 10%;">Dikeluarkan</th>
                        <th style="width: 10%;">Masa Berlaku</th>
                        <th style="width: 10%;">Periode Perpanjangan</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


</div>
<script src="<?= base_url('assets/vendors/jquery/js/jquery.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="<?= base_url('assets/js/datatables.js') ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="<?= base_url('assets/vendors/select2/js/select2.min.js'); ?>"></script>


<script type="text/javascript">
    $('#perizinan_jenisid_edit').select2({
        theme: 'coreui',
        placeholder: '- Pilih Lokasi -',
        allowClear: true,
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        table = $('#tabeldata').DataTable({
            "order": [],
            // "order": [
            //     [1, 'asc']
            // ],
            "processing": true,
            "serverSide": true,
            "destroy": true,
            // "retrieve": true,
            // "paging": false,
            "ajax": {
                "url": "<?php echo site_url('listdataperalatan/ajax_list'); ?>",
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
                    url: "<?php echo site_url('listdataperalatan/delete_alat') ?>/" + id,
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

<?= $this->endSection(); ?>