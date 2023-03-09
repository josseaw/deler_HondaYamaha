function tampilkanSemuaMenu() {
    $.getJSON('json/json.json', (data) => {
        let allData = data.semua;
        $.each(allData, (i, data) => {
            $('#link').append('<div class="col-sm-12 col-md-4 col-lg-4"><div class="card my-2"><img src="img/' + data.gambar + '" class="card-img-top"><div class="card-body"><h5 class="card-title">' + data.nama + '</h5><p class="card-text">' + data.deskripsi + '</p><p class="card-price">Rp. ' + data.harga + '</p><a href="#" class="btn btn-primary right">Buy Now</a></div></div></div>');
        });
    });
};

tampilkanSemuaMenu();

$('.nav-link').on('click', function() {
    $('.nav-link').removeClass('active');
    $(this).addClass('active');

    let kategori = $(this).html();
    $('h1').html(kategori);

    if (kategori == 'Home') {
        tampilkanSemuaMenu();
        return;
    }

    $.getJSON('json/json.json', (data) => {
        let allData = data.semua;
        let content = '';
        $.each(allData, (i, data) => {
            if (data.kategori == kategori.toLowerCase()) {
                content += '<div class="col-sm-12 col-md-4 col-lg-4"><div class="card my-2"><img src="img/' + data.gambar + '" class="card-img-top"><div class="card-body"><h5 class="card-title">' + data.nama + '</h5><p class="card-text">' + data.deskripsi + '</p><p class="card-price">Rp. ' + data.harga + '</p><a href="#" class="btn btn-primary right">Buy Now</a></div></div></div>';
            }
        });
        $('#link').html(content);
    });
});