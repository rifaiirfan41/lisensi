$.validator.setDefaults({
  submitHandler: function submitHandler() {
    let dataRespon = [];
    $.ajax({
      url: 'form/t_form',
      type: "POST",
      dataType: 'json',
      data: $('form').serialize(),

      beforeSend: function () {
        $('.tombolsimpan').prop('disabled', true);
        $('.tombolsimpan').html('Sedang Menyimpan...');
      },
      complete: function () {
        $('.tombolsimpan').prop('disabled', false);
        $('.tombolsimpan').html('Submit');
      },
      success: function (response) {
        console.log(response);
        $.ajax({
          url: "http://localhost:8080/send",
          type: "POST",
          data: $('form').serialize(),
          success: function (res) {
            console.log(res);

            Swal.fire({
              icon: 'success',
              width: 300,
              height: 300,
              text: 'Data berhasil ditambahkan',
              // background: 'linear-gradient(90deg, rgba(214,222,255,0.9724264705882353) 0%, rgba(176,201,255,0.9668242296918768) 100%);',
              showConfirmButton: false,
              timer: 1500
            });
            // setTimeout(function () {
            //   location.reload();
            // }, 1500);

          }

        });

      },

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