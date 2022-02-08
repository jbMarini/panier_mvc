$('.ajaxDirector').click(function(){
    var director = $(this).data('director');
    console.log(director);
    $.ajax({
        method:"GET",
        url:"/search?director="+director
    })
    .done(function( msg ) {
       $('#container').html('');
       $('#container').html(msg);
    });
});