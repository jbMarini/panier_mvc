$('.ajaxTitle').click(function(){
    var title = $('#searchByTitle').val();
    console.log(title);
    $.ajax({
        method:"GET",
        url:"/search?title="+title
    })
    .done(function( msg ) {
       $('#container').html('');
       $('#container').html(msg);
    });
});