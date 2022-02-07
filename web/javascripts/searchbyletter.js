$('.ajaxLetter').click(function(){
    var letter = $(this).data('letter');
    console.log(letter);
    $.ajax({
        method:"GET",
        url:"/search?letter="+letter
    })
    .done(function( msg ) {
       $('#container_movies').html('');
       $('#container_movies').html(msg);
    });
});