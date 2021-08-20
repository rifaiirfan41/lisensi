<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>
<link href="<?= base_url('assets/vendors/date-time/mc-calendar.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendors/filepond/filepond.css'); ?>" rel="stylesheet" />
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<!-- <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"> -->

<style>
    .bsubmit {
        display: inline-block;
        padding: 9px 15px;
        font-size: 15px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none !important;
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
<link href="<?= base_url('assets/vendors/select2/css/select2.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendors/select2/css/select2-coreui.min.css') ?>" rel="stylesheet">

<div class="card">
    <!-- <div class="card-header"> -->

    <!-- </div> -->
    <div class="card-body">
        <!-- <div class="d-flex justify-content-between"> -->
        <div class="tab-content">
            <div class="col-md-12">
                <form id="formperizinan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>Perizinan</h6>
                                <select class="form-control" id="perizinan" name="perizinan">
                                    <option></option>
                                    <?php foreach ($data as $key => $v) { ?>
                                        <option value="<?= $v['idJenisIzin'] ?>"><?= $v['namaJenis'] ?> </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback perizinan"></div>

                            </div>
                            <div class="col-md-12 p-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6>No Perizinan</h6>
                                            <input type="text" name="noperizinan" id="noperizinan" style="border-radius: 13px;" class="form-control" placeholder="" aria-describedby="helpId">
                                            <div class="invalid-feedback errornoperizinan"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6>Nama</h6>
                                            <input type="text" name="nama" id="nama" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                            <div class="invalid-feedback errornama"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h6>Deskripsi</h6>
                                <textarea class="form-control" style="border-radius: 13px;" name="deskripsi" id="deskripsi" rows="3"></textarea>
                                <div class="invalid-feedback errordeskripsi"></div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group" height="330px">
                                <input type="file" class="filepond" id="filepond" name="filepond" multiple data-allow-reorder="true" data-max-files="1000">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>Tanggal Aktif</h6>
                                <input type="date" name="tglaktif" id="tglaktif" class="form-control" style="border-radius: 13px;">
                                <div class="invalid-feedback errortglaktif"></div>
                            </div>
                            <div class="form-group">
                                <h6>Dikeluarkan :</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>Tanggal Berlaku</h6>
                                <input type="date" name="tglberlaku" id="tglberlaku" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                <div class="invalid-feedback errortglberlaku"></div>
                            </div>
                            <br><br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>Nama Instansi</h6>
                                <input type="text" name="instansi" id="instansi" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                <div class="invalid-feedback errorinstansi"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>Alamat</h6>
                                <input type="text" name="alamat" id="alamat" class="form-control " style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                <div class="invalid-feedback erroralamat"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h6>Notes</h6>
                        <input type="text" name="catatan" id="" style="border-radius: 13px;" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <br><br>
                    <div class="form-group">
                        <center><button id="send_form" type="submit" class="bsubmit tombolsimpan">Submit</button></center>
                    </div>
                </form>
                <?php // form_close() 
                ?>
                <br><br>
            </div>
        </div>
    </div>
</div>

<!-- /.card-->
<script src="<?= base_url('assets/vendors/jquery/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/moment/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/select2/js/select2.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/date-time/mc-calendar.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/jquery-validation/js/jquery.validate.js'); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- add before </body> -->
<script src="<?= base_url('assets/vendors/filepond/filepond.js'); ?>"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script>
    var send = '<?= base_url() ?>send';
    var filepond = FilePond.create(
        document.querySelector('[name=filepond]'), {
            allowFileSizeValidation: true,
            maxFileSize: '5MB',
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg', 'application/pdf', 'image/tiff', 'image/tif'],
            fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                resolve(type);
            })
        });

    filepond.setOptions({
        maxFiles: 2,
        server: {
            url: '<?= base_url('listdataperizinan/filenya') ?>',
        }
    });
</script>
<script src="<?= base_url('assets/js/vperizinan.js'); ?>"></script>
<script>

</script>

<script>
    $(document).ready(function() {
        const myDatePicker = MCDatepicker.create({
            el: '#tglaktif',
            dateFormat: 'YYYY-MM-DD',
            // color: '#185adb',
        });
        const myDatePicker1 = MCDatepicker.create({
            el: '#tglberlaku',
            dateFormat: 'YYYY-MM-DD',
            // color: '#185adb',
        });

        $('#perizinan').select2({
            theme: 'coreui',
            placeholder: '- Pilih Perizinan -',
            allowClear: true
        });

    });
</script>
<script>
    $.validator.setDefaults({
        submitHandler: function submitHandler() {
            let dataRespon = [];
            $.ajax({
                url: 't_form',
                type: "POST",
                dataType: 'json',
                data: $('form').serialize(),
                beforeSend: function() {
                    $('.tombolsimpan').prop('disabled', true);
                    $('.tombolsimpan').html('Sedang Menyimpan...');
                },
                complete: function() {
                    $('.tombolsimpan').prop('disabled', false);
                    $('.tombolsimpan').html('Submit');
                },
                success: function(response) {
                    $.ajax({
                        url: "send",
                        type: "POST",
                        data: $('form').serialize(),
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                width: 300,
                                height: 300,
                                text: 'Data berhasil ditambahkan',
                                // background: 'linear-gradient(90deg, rgba(214,222,255,0.9724264705882353) 0%, rgba(176,201,255,0.9668242296918768) 100%);',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1500);

                        }

                    });

                }
            });
        }
    });
    $('#formperizinan').validate({
        rules: {
            perizinan: 'required',
            noperizinan: 'required',
            nama: 'required',
            lokasi: 'required',
            deskripsi: 'required',
            tglaktif: 'required',
            tglberlaku: 'required',
            instansi: 'required',
            alamat: 'required',
        },
        messages: {
            perizinan: 'Wajib pilih perizinan',
            noperizinan: 'Nomor perizinan tidak boleh kosong',
            nama: 'Nama tidak boleh kosong',
            lokasi: 'Wajib pilih lokasi',
            deskripsi: 'Deskripsi tidak boleh kosong',
            tglaktif: 'Wajib mengatur tanggal aktif',
            tglberlaku: 'Wajib mengatur tanggal berlaku',
            instansi: 'Nama Instansi tidak boleh kosong',
            alamat: 'Alamat tidak boleh kosong',

        },
        errorElement: 'em',
        errorPlacement: function errorPlacement(error, element) {
            error.addClass('invalid-feedback');

            if (element.prop('type') === 'checkbox') {
                error.insertAfter(element.parent('label'));
            } else {
                error.insertAfter(element);
            }
        },
        // eslint-disable-next-line object-shorthand
        highlight: function highlight(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        // eslint-disable-next-line object-shorthand
        unhighlight: function unhighlight(element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
    $('.bgn').fadeOut('slow');
</script>
<?= $this->endSection(); ?>