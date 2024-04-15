$('.imagenPost').each(function (i){
    let row = $(this)
    row.attr('id','imagenPost' + i);
});

$('.imagen').click(function (e){
    e.preventDefault();
    let src = $(this).attr('src');
    $('#imagenModal').attr('src',src);
});

$('#unfollow').mouseover(function (){
    $(this).removeClass('px-4');
    $(this).text('Dejar de seguir');
});
$('#unfollow').mouseleave(function (){
    $(this).addClass('px-4');
   $(this).text('Siguiendo');
});

$('#editButton').click(function () {
    $(this).hide();
    $("#biografiaArea").removeAttr("disabled");
    $('#applyButton').show();
    $("#biografiaArea").focus();
});

$('#textArea').on('input', function () {
    this.style.height = 'auto';
    this.style.height =
        (this.scrollHeight) + 'px';
});

$('#applyButton').mouseover(function (){
    let bio = $("#biografiaArea").val();
    $('#biografiaInput').val(bio);
});

if($("#textArea").val().trim().length < 1){
}

if ($('#textArea').val().length == 0) {
    $('#subPost').removeAttr("disabled");
}

$('#goProfile').click(function (e){
    goProfile(e);
});
$('#nameUser').click(function (e){
    goProfile(e);
});
function goProfile (e){
    e.preventDefault();
    window.location.href = $('#rutaProfileUser').val() ;
}
