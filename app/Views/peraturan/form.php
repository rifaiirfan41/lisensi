<?= $this->extend('layout/index'); ?>
<?= $this->section('konten'); ?>

<link href="<?= base_url('assets/vendors/select2/css/select2.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendors/select2/css/select2-coreui.min.css') ?>" rel="stylesheet">
<!-- <link href="<?php //echo base_url('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css'); 
                    ?>" rel="stylesheet"> -->
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
        <form id="formperaturan" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h6>Jenis Peraturan</h6>
                            <select class="form-control" id="peraturan" name="peraturan">
                                <option></option>
                                <?php foreach ($data as $key => $v) { ?>
                                    <option value="<?= $v['idJenisIdentifikasi'] ?>"><?= $v['nama'] ?> </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback peraturan"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h6>No Peraturan</h6>
                            <input type="text" name="noperaturan" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            <div class="invalid-feedback noperaturan"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <h6>Judul</h6>
                            <input type="text" class="form-control" style="border-radius: 13px;" name="judul" />
                            <div class="invalid-feedback judul"></div>
                        </div>
                        <br>
                        <h6>Bagian Yang Relevan</h6><br>
                    </div>
                    <div class="col-md-12" style="border: 2px;">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6>BAB</h6>
                                    <input type="text" name="bab" id="bab" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                    <div class="invalid-feedback bab"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6>Pasal</h6>
                                    <input type="text" name="pasal" id="pasal" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                    <div class="invalid-feedback pasal"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6>AYAT</h6>
                                    <input type="text" name="ayat" id="ayat" class="form-control" style="border-radius: 13px;" placeholder="" aria-describedby="helpId">
                                    <div class="invalid-feedback ayat"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h6>Tentang</h6>
                                    <textarea class="form-control" style="border-radius: 13px;" name="tentang" id="tentang" rows="2"></textarea>
                                    <div class="invalid-feedback tentang"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12"> -->
                    <div class="col-md-12">
                        <br>
                        <h6>Implementasi</h6>
                        <br>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h6>Fasilitas</h6>
                            <input type="text" name="fasilitas" id="fasilitas" class="form-control" placeholder="" aria-describedby="helpId">
                            <div class="invalid-feedback fasilitas"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h6>Dokumen Kerja</h6>
                            <input type="text" name="dokkerja" id="dokkerja" class="form-control" placeholder="" aria-describedby="helpId">
                            <div class="invalid-feedback dokkerja"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h6>Status Pemenuhan</h6>
                            <select name="status" class="form-control" style="border-radius: 13px;" id="status">
                                <option value="">- Pilih -</option>
                                <option value="Sudah">Sudah</option>
                                <option value="Proses">Proses</option>
                                <option value="Belum">Belum</option>
                            </select>
                            <div class="invalid-feedback status"></div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <h6>Keterangan</h6>
                            <textarea class="form-control" style="border-radius: 13px;" name="keterangan" id="keterangan" rows="2"></textarea>
                            <div class="invalid-feedback keterangan"></div>
                        </div>
                        <br>
                    </div>
                    <!-- <div class="col-md-2">
                    <div class="form-group">
                        <input type="button" class="btn btn-success" onclick="tambahItem('tb_out')" value="+" />
                    </div>
                    <br>
                </div>
                <div class="col-md-12">
                    <table class="table" cellspacing="0" border="1" id="tb_out">
                        <tbody>
                            <tr>
                                <td>BAB</td>
                                <td>PASAL</td>
                                <td>AYAT</td>
                                <td>Tentang</td>
                                <td>Fasilitas</td>
                                <td>Dokumen Kerja</td>
                                <td>Status</td>
                                <td>Keterangan</td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellspacing="0" border="1" id="tb_total">
                        <tbody>

                        </tbody>
                    </table>
                </div> -->
                    <br><br>
                </div>
                <div class="form-group">
                    <center><button id="send_form" type="submit" class="bsubmit tombolsimpan">Submit</button></center>
                </div>
                <br><br>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('assets/vendors/jquery/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/moment/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/select2/js/select2.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/date-time/mc-calendar.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendors/jquery-validation/js/jquery.validate.js'); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets/js/vperaturan.js'); ?>"></script>

<!-- <script type="text/javascript">
        let dataTableForm = [];

        function tambahItem(idTabel) {
            //menntukan tabel yang akan di update
            var idtabel = document.getElementById(idTabel);
            //membaca form isian
            var bab = document.getElementById('bab').value;
            var pasal = document.getElementById('pasal').value;
            var ayat = document.getElementById('ayat').value;
            var tentang = document.getElementById('tentang').value;
            var fasilitas = document.getElementById('fasilitas').value;
            var dokkerja = document.getElementById('dokkerja').value;
            var status = document.getElementById('status').value;
            var keterangan = document.getElementById('keterangan').value;

            dataTableForm.push({
                bab: bab,
                pasal: pasal,
                ayat: ayat,
                tentang: tentang,
                fasilitas: fasilitas,
                dokkerja: dokkerja,
                status: status,
                keterangan: keterangan,
            });

            //menambah baris pada table
            var jumBaris = idtabel.rows.length;
            var baris = idtabel.insertRow(jumBaris);
            //mengisi setiap kolom dengan isian form
            var kolom1 = baris.insertCell(0);
            var kolom2 = baris.insertCell(1);
            var kolom3 = baris.insertCell(2);
            var kolom4 = baris.insertCell(3);
            var kolom5 = baris.insertCell(4);
            var kolom6 = baris.insertCell(5);
            var kolom7 = baris.insertCell(6);
            var kolom8 = baris.insertCell(7);
            // var kolom9 = baris.insertCell(8);

            kolom1.innerHTML = bab;
            kolom2.innerHTML = pasal;
            kolom3.innerHTML = ayat;
            kolom4.innerHTML = tentang;
            kolom5.innerHTML = fasilitas;
            kolom6.innerHTML = dokkerja;
            kolom7.innerHTML = status;
            kolom8.innerHTML = keterangan;

            //set from isina menjadi kosong  
            document.getElementById('bab').value = '';
            document.getElementById('pasal').value = '';
            document.getElementById('ayat').value = '';
            document.getElementById('tentang').value = '';
            document.getElementById('fasilitas').value = '';
            document.getElementById('dokkerja').value = '';
            document.getElementById('status').value = '';
            document.getElementById('keterangan').value = '';
            // document.getElementById('tombol').value = '';

            var total = 0;
            var table = document.getElementById('tb_out');
            for (var r = 1; r <= table.rows.length - 1; r++) {
                var x = parseInt(document.getElementById('tb_out').rows[r].cells[7].innerHTML);
                // console.log(table.rows.length);
            }
            // console.log(r);

        }

        function hapusRow() {
            var tbl = document.getElementById('tb_out');
            var lastRow = tbl.rows.length;
            if (lastRow > 1) {
                tbl.deleteRow(lastRow - 1);
                var total = 0;
                var table = document.getElementById('tb_out');
                for (var r = 1; r <= table.rows.length - 1; r++) {
                    var x = parseInt(document.getElementById('tb_out').rows[r].cells[4].innerHTML);
                }
            } else if (lastRow = 1) {
                document.getElementById('hasil').innerHTML = '&nbsp;';
            }
        }
    </script> -->
<script>
    $('#peraturan').select2({
        theme: 'coreui',
        placeholder: '- Pilih Peraturan -',
        allowClear: true,
    });
    $('.bgn').fadeOut('slow');
</script>
<!-- /.card-->
<?= $this->endSection(); ?>