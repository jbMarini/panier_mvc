$('.ajaxName').click(function(){
    var name = $('#searchByTitle').val();
    console.log(name);
    $.ajax({
        method:"GET",
        url:"/search?name="+name
    })
    .done(function( msg ) {
       $('#container').html('');
       $('#container').html(msg);
    });
});