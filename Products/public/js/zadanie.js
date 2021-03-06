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
            if(response[5] != null) {
                var updated = response[5];
                var updated = updated.replace(/ /g, 'T');
                $('#modal-update').val(updated);
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
        data : { name : name, description : desc , price : price , price_name : price_name, date : date, _token : token },
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

$('.modal-footer .btn-danger').click(function () {

    var name = $('.modal-title').text();
    var token_delete =  $('#token').val();

    $.ajax({
        url: "/zadanie/delete",
        type: "post",
        data : { name : name, _token : token_delete},
        success: function (response) {
            alert('connected');
            if(response === 'error') {
                alert ('eror');
            }
            if(response === 'deleted') {
                alert ('deleted');
                location.reload();
            }
        },
    });
});

$('.modal-header h4').click(function () {
    $(this).after('<div class="new-name">New name : <input type="text"></div>');
    $('.modal-footer .btn-success').click(function  (){
        $('.modal-header .new-name').remove()
    })
});

$('.modal-description textarea').click(function () {
    $(this).attr('readonly', false);
    $('.modal-footer .btn-success').click(function  (){
        $('.modal-description textarea').attr('readonly', true);
        })
});

$('.modal-footer .btn-success').click(function () {
    $('#modal-update').val('');
});

$('.modal-footer .btn-warning').click(function () {

    var name_old = $('.modal-title').text();
    var name = $('.new-name input').val();
    var desc = $('#desc').val();
    var token_update =  $('#token').val();

    $.ajax({
        url: "/zadanie/update",
        type: "post",
        data : { name_old : name_old, name : name, description : desc, _token : token_update },
        success: function (response) {
            alert('connected');
            if(response === 'error') {
                alert ('error');
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