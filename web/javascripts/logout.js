$('#logout').click(function(){
    var id = $('#id').val();
    $.ajax({
        method: "GET",
        url: "/logout"
    })
    .done(function(dataResult){
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode==200) {
            alert('Vous êtes maintenant déconnecté');
            location.reload()
        }else {
            alert(dataResult);
        }
    })
})