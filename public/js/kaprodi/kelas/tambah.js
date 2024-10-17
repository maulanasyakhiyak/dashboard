var selector = $('#dosen_input');

var im = new Inputmask("DOS999999");
im.mask(selector)

$('#dosen_input').autocomplete({
    source: function(request,response){
        $.ajax({
            url:'/search',
            dataType:'json',
            data:{
                term:request.term
            },
            success: function(data){
                var results = data.map(function(item) {
                    return {
                        label: item.kode_dosen + " - " + item.name, // Menampilkan kode_dosen dan nama
                        value: item.kode_dosen // Nilai yang akan disimpan di input
                    };
                });
                response(results);
                
            }
        })
    },
    minLength: 2
})