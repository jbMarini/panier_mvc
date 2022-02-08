$('.ajaxLetter').click(function(){
    var letter = $(this).data('letter');
    console.log(letter);
    $.ajax({
        method:"GET",
        url:"/search?letter="+letter
    })
    .done(function( msg ) {
       $('#container').html('');
       $('#container').html(msg);
    });
});