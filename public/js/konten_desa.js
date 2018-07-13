var judul = $("#judul_konten");
var konten = $("#konten_desa");

$("#selayang_pandang").click(function(e){
    $.get("api/konten_desa/"+id_desa+"/selayang_pandang", function(data){
        judul.html('Selayang Pandang');
        konten.html(data);
        $('html, body').animate({
            scrollTop: $("#cont").offset().top
        }, 1000);
    });
});