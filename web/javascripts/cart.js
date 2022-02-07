$('.cart').click(function(){
    var id = $('#idcart').val();
    $.ajax({
        method: "GET",
        url: "/addcart?add="+id
    })
    .done(function(msg){
        alert('Ajout au panier effectué');
        if($('.nbPanier').length == ''){
            $('.float-left.menu-panier').after('<i class="float-left fas fa-certificate red-text"><span class="nbPanier">1</span></i>');
        }else{
            $('.nbPanier').html(parseInt($('.nbPanier').html(), 10)+1)
        }
    })
})