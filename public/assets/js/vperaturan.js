$.validator.setDefaults({
  submitHandler: function submitHandler() {
    // let dataRespon = [];
    $.ajax({
      url: "tamform",
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
        console.log(response);
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
       
      },
  });
  }
});
$('#formperaturan').validate({
  rules: {
    peraturan: 'required',
    noperaturan: 'required',
    judul: 'required',
    bab: 'required',
    pasal: 'required',
    ayat: 'required',
    tentang: 'required',
    fasilitas: 'required',
    dokkerja: 'required',
    status: 'required',
    keterangan: 'required',
  },
  messages: {
    peraturan: 'Wajib pilih peraturan',
    noperaturan: 'Nomor peraturan tidak boleh kosong',
    judul: 'Juduk tidak boleh kosong',
    bab: 'Jika tidak diisi beri tanda strip (-)',
    pasal: 'Jika tidak diisi beri tanda strip (-)',
    ayat: 'Jika tidak diisi beri tanda strip (-)',
    tentang: 'Jika tidak diisi beri tanda strip (-)',
    fasilitas: 'Fasilitas tidak boleh kosong',
    dokkerja: 'Dokumen Kerja tidak boleh kosong',
    status: 'Wajib pilih S=status',
    keterangan: 'Jika tidak diisi beri tanda strip (-)',
   
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