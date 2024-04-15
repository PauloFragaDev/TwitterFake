$('.deleteRow').each(function (i){
    let row = $(this)
    row.attr('id','deleteRow' + i);
    console.log(row);
});

$('.deleteBtn').click(function (){
    let idUser = $(this).val();
    $('#user_id').val(idUser);
});
