$('.ajaxActor').click(function(){
    var actor = $(this).data('actor');
    console.log(actor);
    $.ajax({
        method:"GET",
        url:"/search?actor="+actor
    })
    .done(function( msg ) {
       $('#container').html('');
       $('#container').html(msg);
    });
});