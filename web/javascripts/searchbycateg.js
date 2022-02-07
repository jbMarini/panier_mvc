$('.ajaxCategorie').click(function(){
    var genre = $(this).data('id');
    console.log(genre);
    $.ajax({
        method:"GET",
        url:"/search?genre="+genre
    })
    .done(function( msg ) {
       $('#container_movies').html('');
       $('#container_movies').html(msg);
    });
});