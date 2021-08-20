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
<ul class="nav nav-tabs" role="tablist" style="border-bottom: 0;">
    <li class="nav-item btn-secondary"><a class="nav-link btn-secondary active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home">Form Perizinan</a></li>
    <li class="nav-item btn-secondary"><a class="nav-link btn-secondary" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile">Form Peralatan</a></li>
</ul>
<div class="card">
    <!-- <div class="card-header"> -->

    <!-- </div> -->
    <div class="card-body">

        <!-- <div class="d-flex justify-content-between"> -->
        <div class="tab-content">
            <div class="tab-pane active" id="home-1" role="tabpanel">
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
            <div class="tab-pane" id="profile-1" role="tabpanel">
                <div class="col-md-12">
                    <form id="formperalatan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6>Peralatan</h6>
                                    <select class="form-control" id="peralatan" name="peralatan">
                                        <option></option>
                                        <?php foreach ($alat as $key => $al) { ?>
                                            <option value="<?= $al['idPeralatan'] ?>"><?= $al['namaPeralatan'] ?> </option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback peralatan"></div>
                                </div>
                                <div class="col-md-12 p-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6>No Dokumen</h6>
                                                <input type="text" name="nodokumen" id="nodokumen" style="border-radius: 13px;" class="form-control" placeholder="" aria-describedby="helpId">
                                                <div class="invalid-feedback errornodokumen"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6>No Pengesahan</h6>
                                                <input type="text" name="nopengesahan" id="nopengesahan" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                                <div class="invalid-feedback errornopengesahan"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 p-0">
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <h6>No Urut Dokumen</h6>
                                                <input type="number" name="nourut" id="nourut" style="border-radius: 13px;" class="form-control" placeholder="" aria-describedby="helpId">
                                                <div class="invalid-feedback errorkapasitas"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h6>Kapasitas</h6>
                                                <input type="text" name="kapasitas" id="kapasitas" style="border-radius: 13px;" class="form-control" placeholder="" aria-describedby="helpId">
                                                <div class="invalid-feedback errorkapasitas"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 p-0">
                                    <div class="form-group">
                                        <h6>Lokasi</h6>
                                        <select name="lokasi2" id="lokasi2" class="form-control" style="border-radius: 13px;" id="">
                                            <option></option>
                                            <?php foreach ($lokasi as $key => $cl) { ?>
                                                <option value="<?= $cl['idLokasi'] ?>"><?= $cl['nama'] ?> </option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback errorlokasi2"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group" height="330px">
                                    <input type="file" name="filenya" id="filenya" class="filenya" multiple>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6>Tanggal Dikeluarkan</h6>
                                    <input type="date" name="tglkeluar" id="tglkeluar" class="form-control" style="border-radius: 13px;">
                                    <div class="invalid-feedback errortglkeluar"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6>Masa Berlaku</h6>
                                    <input type="date" name="masaberlaku" id="masaberlaku" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                    <div class="invalid-feedback errormasaberlaku"></div>
                                </div>
                                <br><br>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6>Periode Perpanjangan</h6>
                                    <input type="text" name="panjang" id="panjang" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                    <div class="invalid-feedback errorpanjang"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6>Keterangan</h6>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control " style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                    <div class="invalid-feedback errorketerangan"></div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <center><button id="kirim1" type="submit" class="bsubmit tombolsimpan1">Submit</button></center>
                        </div>
                    </form>

                    <br><br>
                </div>
            </div>
        </div>
        <!-- </div> -->

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
            url: '<?= base_url('form/filenya') ?>',
        }
    });
    const inputElement1 = document.querySelector('input[id="filenya"]');
    const pond1 = FilePond.create(inputElement1, {
        credits: false,
        allowFileTypeValidation: true,
        acceptedFileTypes: ['image/png'],
        labelFileTypeNotAllowed: 'File tidak diperbolehkan',
        allowFileSizeValidation: true,
        maxFileSize: '5MB',
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg', 'application/pdf', 'image/tiff', 'image/tif'],
        fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {

            // Do custom type detection here and return with promise

            resolve(type);
        })
    });
    pond1.setOptions({
        maxFiles: 2,
        required: true,
        server: {
            url: '<?= base_url('form/filenya') ?>'
        }
    });
</script>
<script src="<?= base_url('assets/js/vperizinan.js'); ?>"></script>
<script src="<?= base_url('assets/js/vperalatan.js'); ?>"></script>
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
        const myDatePicker2 = MCDatepicker.create({
            el: '#tglkeluar',
            dateFormat: 'YYYY-MM-DD',
            // color: '#185adb',
        });
        const myDatePicker3 = MCDatepicker.create({
            el: '#masaberlaku',
            dateFormat: 'YYYY-MM-DD',
            // color: '#185adb',
        });
        $('#perizinan ').select2({
            theme: 'coreui',
            placeholder: '- Pilih Perizinan -',
            allowClear: true
        });
        $('#peralatan ').select2({
            theme: 'coreui',
            placeholder: '- Pilih Peralatan -',
            allowClear: true
        });
        $('#lokasi2').select2({
            theme: 'coreui',
            placeholder: '- Pilih Lokasi -',
            allowClear: true,
        });
    });
</script>

<?= $this->endSection(); ?>