$.validator.setDefaults({
  submitHandler: function submitHandler() {

    $.ajax({
      url: "form/t_formalat",
      type: "POST",
      data: $('form').serialize(),
      beforeSend: function() {
          $('.tombolsimpan1').prop('disabled', true);
          $('.tombolsimpan1').html('Sedang Menyimpan...');
      },
      complete: function() {
          $('.tombolsimpan1').prop('disabled', false);
          $('.tombolsimpan1').html('Submit');
      },
      success: function(response) {
        console.log(response);
        console.log(response.success);
        $.ajax({
          url: "send/kedua",
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
$('#formperalatan').validate({
  rules: {
    peralatan: 'required',
    nodokumen: 'required',
    nopengesahan: 'required',
    // nourut: 'required',
    kapasitas: 'required',
    lokasi2: 'required',
    tglkeluar: 'required',
    masaberlaku: 'required',
    panjang: 'required',
    keterangan: 'required',
  },
  messages: {
    peralatan: 'Wajib pilih peralatan',
    nodokumen: 'Nomor dokumen tidak boleh kosong',
    nopengesahan: 'Nomor pengesahan tidak boleh kosong',
    // nourut: 'Wajib mengisi nomor urut dokumen',
    kapasitas: 'Kapasitas tidak boleh kosong',
    lokasi2: 'Wajib pilih lokasi',
    tglkeluar: 'Wajib mengatur tanggal keluar',
    masaberlaku: 'Wajib mengatur masa berlaku',
    panjang: 'Periode perpanjangan tidak boleh kosong',
    keterangan: 'Keterangan tidak boleh kosong',
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