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