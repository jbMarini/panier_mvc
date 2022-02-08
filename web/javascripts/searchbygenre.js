$('.ajaxGenre').click(function(){
    var genre = $(this).data('genre');
    console.log(genre);
    $.ajax({
        method:"GET",
        url:"/search?genre="+genre
    })
    .done(function( msg ) {
       $('#container').html('');
       $('#container').html(msg);
    });
});