$('.ajaxName').click(function(){
    var name = $('#searchByTitle').val();
    console.log(name);
    $.ajax({
        method:"GET",
        url:"/search?name="+name
    })
    .done(function( msg ) {
       $('#container_movies').html('');
       $('#container_movies').html(msg);
    });
});