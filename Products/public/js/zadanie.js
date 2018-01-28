$('.list-group-item').click(function () {
    var product = $(this).text();
    $('.modal-title').text(product);

    var token = $('#token').val();

    $.ajax({
        url: "/zadanie/details",
        type: "post",
        data : { name : product, _token : token },
        success: function (response) {
            var description = response[0][0]["description"];
            $('.modal-description textarea').text(description);
            var date = response[1][0]["created"];
            var date = date.replace(/ /g, 'T');
            $('#modal-date').val(date);
            if(response[2] != null) {
                var price_normal = response[2];
                $('.normal-value').text(price_normal);
            }
            if(response[2] == null) {
                $('.normal-value').text('');
            }
            if(response[3] != null) {
                var price_hot = response[3];
                $('.hot-value').text(price_hot);

            }
            if(response[3] == null) {
                $('.hot-value').text('');
            }
            if(response[4] != null) {
                var price_sale = response[4];
                $('.sale-value').text(price_sale);
            }
            if(response[4] == null) {
                $('.sale-value').text('');
            }
            if(response === 'error') {
                alert ('error');
            }
        },
    });
});



$('.add.new .btn-success').click(function () {

    var name = $('#name').val();
    var desc = $('#desc').val();
    var price = $('#price').val();
    var price_name = $('#price_name').val();
    var date = $('#date').val();
    var token = $('#token').val();

    $.ajax({
        url: "/zadanie/add",
        type: "post",
        data : { name : name, description : desc , price : price , price_name : price_name, date : date, _token : token},
        success: function (response) {
           alert('connected');
           if(response === 'missing data') {
               alert ('missing data');
           }
           if(response === 'saved') {
               alert ('saved');
           }
        },
    });
});

$('.add.new .back').click(function () {
    window.location.href = "/zadanie";
});