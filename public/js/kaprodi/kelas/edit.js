var dataDump = [];

function addCard(label, id) {
  var card = $("<div>", {
    class:"itemVal w-full border p-4 mb-3 border-green-400 rounded-lg flex justify-between",
    id: id,
  });

  var labelDiv = $("<div>").text(label);
  var deleteButton = $("<button>", {
    type: "button",
    class: "text-red-500",
    onclick: `deleteCard(${id})`,
  }).html('<i class="fa-solid fa-x"></i>');

  card.append(labelDiv).append(deleteButton);
  $("#input_group").append(card);
}

function deleteCard(id) {
  dataDump = dataDump.filter((num) => num !== id);
  $(`#${id}`).remove();
}

$(document).ready(function () {
  console.log(dataDump);

  // CHECKING INPUT
  var inputChanged = false;
  $("#form-edit input").on("input", function () {
    inputChanged = true;
  });

  $(window).on("beforeunload", function () {
    if (inputChanged) {
      return "Ada perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman?";
    }
  });

  // INPUTMASK
  var dosen = new Inputmask("DOS999999");
  var mahasiswa = new Inputmask("999999");

  dosen.mask($("#dosen_input"));
  mahasiswa.mask($("#mahasiswa_input"));

  // DOSEN AUTOCOMPLETE
  $("#dosen_input").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: "/search",
        dataType: "json",
        data: {
          kode_dosen: $("#dosen_input").data("value"),
          from: "edit_kelas",
          term: request.term,
        },
        success: function (data) {
          var results = data.map(function (item) {
            return {
              label: item.kode_dosen + " - " + item.name,
              value: item.kode_dosen,
            };
          });
          response(results);
        },
      });
    },
    minLength: 2,
  });

  // MAHASISWA AUTOCOMPLETE
  $("#mahasiswa_input").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: "/search",
        dataType: "json",
        data: {
          from: "edit_kelas-mahasiswa",
          except: dataDump,
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
    select: function (event, ui) {
      dataDump.push(ui.item.id);
      console.log(dataDump);
      $(this).val("");
      addCard(ui.item.label, ui.item.id);
      return false;
    },
  });

  // FORM UPDATE
  $("#form-edit").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
      url:$(this).attr('action'),
      type:'POST',
      dataType:'json',
      data:{
        _token: $('meta[name="csrf-token"]').attr('content'),
        idKelas:$(this).data('idkelas'),
        newclass:$("#nama_kelas").val(),
        oldDosen:$("#dosen_input").data("value"),
        newDosen:$("#dosen_input").val(),
        newMhs:dataDump
      },
      success: function(data){
        if(data['status'] === 'success'){
          alert(data['message']);
          location.reload()
        }else{
          alert(data['message']);
          location.reload()
        }
        
        
      }
    })
  });
});
