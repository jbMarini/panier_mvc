$('#buttonsearch').click(function(){
    var data= $('#searchByTitle').val();
    console.log(data);
    $.ajax({
        method: "GET",
        url:  "/tmdb?search="+data,
    });
});