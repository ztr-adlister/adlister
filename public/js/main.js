$(document).ready(function() { 
    
    $('input[name=clickcategory]').change(function(){
        $('form').submit();
    });

    $('.fa-bars').click(function(){
        $('.secondarynav').slideToggle();
    });
    
});