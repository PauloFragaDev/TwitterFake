$('.imagenPost').each(function (i){
    let row = $(this)
    row.attr('id','imagenPost' + i);
});

$('.imagen').click(function (e){
    e.preventDefault();
    let src = $(this).attr('src');
    $('#imagenModal').attr('src',src);
});

$('#goProfile').click(function (e){
    e.preventDefault();
    goProfile(e);
});
$('#nameUser').click(function (e){
    e.preventDefault();
    goProfile(e);
});
function goProfile (e){
    e.preventDefault();
    window.location.href = $('#rutaProfileUser').val() ;
}
