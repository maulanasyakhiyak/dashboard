var initialData = {
  name_mhs: $("#name_edt_mhs").val(),
  tempat_lahir_mahasiswa: $("#tmpt_lhr_edt_mhs").val(),
  tanggal_lahir_mahasiswa: $("#tgl_lhr_edt_mhs").val(),
};

var mahasiswa = new Inputmask("999999");
mahasiswa.mask($("#tambah_mahasiswa"));

$("#tambah_mahasiswa").autocomplete({
  source: function (request, response) {
    $.ajax({
      url: "/search",
      dataType: "json",
      data: {
        from: "edit_kelas-mahasiswa",
        term: request.term,
      },
      success: function (data) {
        var results = [];
        data.forEach(function (item) {
          results.push({
            label: item.nim + " - " + item.name,
            value: item.nim,
            id: item.id,
          });
        });
        response(results);
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
      },
    });
  },
  minLength: 2,
});

$(".keluar_form").on("submit", function (e) {
  e.preventDefault(); // Mencegah form submit secara otomatis

  Swal.fire({
    title: "Apakah kamu yakin?",
    text: "Kamu tidak bisa mengembalikan perubahan ini!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, hapus!",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      this.submit();
    }
  });
});

$(".form_edt_mhs").on("submit", function (e) {
  e.preventDefault();


  var currentData = {
    name_mhs: $("#name_edt_mhs").val(),
    tempat_lahir_mahasiswa: $("#tmpt_lhr_edt_mhs").val(),
    tanggal_lahir_mahasiswa: $("#tgl_lhr_edt_mhs").val(),
  };

  var changedData = {};

  if (currentData.name_mhs !== initialData.name_mhs) {
    changedData.name_mhs = currentData.name_mhs;
  }

  if (
    currentData.tempat_lahir_mahasiswa !== initialData.tempat_lahir_mahasiswa
  ) {
    changedData.tempat_lahir_mahasiswa = currentData.tempat_lahir_mahasiswa;
  }

  if (
    currentData.tanggal_lahir_mahasiswa !== initialData.tanggal_lahir_mahasiswa
  ) {
    changedData.tanggal_lahir_mahasiswa = currentData.tanggal_lahir_mahasiswa;
  }

  if (Object.keys(changedData).length > 0) {
    changedData._token = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
      url: $(this).attr("action"),
      type:'POST',
      dataType: "json",
      data: changedData,
      success: function (res) {
        if(res.status == 'success'){
          Swal.fire({
            icon: "success",
            title: "Data Berhasil Diperbarui!",
            text: res.message,
            showConfirmButton: false,
            timer: 2000, // Menghilang dalam 2 detik
          }).then(() => {
            // Redirect setelah 2 detik (atau lebih sesuai kebutuhan)
            window.location.href = res.redirect; // Redirect ke URL yang dikirim dari server
          });
        }else{
          console.log('data tidak terkirim');
          
        }
      },
      error: function (xhr, status, error) {
        console.error("Gagal mengirim data:", error);
      },
    });
  }
});
