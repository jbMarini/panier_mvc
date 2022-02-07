$('.fa-plus').click(function(){
    var id = $(this).data('id');
    $.ajax({
        method:"GET",
        url:"/addcart?add="+id
    })
    .done(function(msg){
        var quantite = parseInt($('.quantity_'+id).html(),10);
        $('.quantity_'+id).html(quantite+1);
        $('.nbPanier').html(parseFloat($('.nbPanier').html(),2)+1);
        
        var price = parseFloat($('.price_'+id).html(), 2);
        $('.total_'+id).html(parseFloat(((quantite+1)*price)).toFixed(2));

        var supertotal = 0;
        $('tr[class^="row_"]').each(function()
        {
            var id = $(this).data('id');
            supertotal+=parseFloat($('.quantity_'+id).html(), 2) * parseFloat($('.price_'+id).html(), 2);
            $('.supertotal').html(parseFloat(supertotal).toFixed(2));
        })
    })
})

$('.fa-minus').click(function(){
    var id = $(this).data('id');
    $.ajax({
        method:"GET",
        url:"/addcart?remove="+id
    })
    .done(function(msg){
        var quantite = parseInt($('.quantity_'+id).html(),10);
        $('.quantity_'+id).html(quantite-1);
        $('.nbPanier').html(parseFloat($('.nbPanier').html(),2)-1);
        
        var price = parseFloat($('.price_'+id).html(), 2);
        $('.total_'+id).html(parseFloat(((quantite-1)*price)).toFixed(2));

        var supertotal = 0;
        $('tr[class^="row_"]').each(function()
        {
            var id = $(this).data('id');
            supertotal+=parseFloat($('.quantity_'+id).html(), 2) * parseFloat($('.price_'+id).html(), 2);
            $('.supertotal').html(parseFloat(supertotal).toFixed(2));
            if(supertotal ==0){
                $('.float-left').remove();
            }
            if($('.quantity_'+id).html()==0){
                supertotal = 0;
            }
            if($('.quantity_'+id).html()==0){
                $('.row_'+id).remove();
            }
        })
    })
})