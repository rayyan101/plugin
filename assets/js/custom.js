jQuery(document).ready(function($){ 
    $("#keyword").on("keyup",function(){
        var keyword = $(this).val();
        // alert(keyword);
        jQuery.ajax({
            url:   ajax_object.ajaxurl,
            type: 'POST',
            data: { 
                action: 'cpf_searching_data_cpt_movies',  
                keyword: keyword 
            },
            success: function(data) {
                jQuery('#datafetch').html( data );
            }
        });
    });
    $("#language").change(function(){
        var keyword = $(this).find("option:selected").val();

        // alert(keyword);
        jQuery.ajax({
            url:   ajax_object.ajaxurl,
            type: 'POST',
            data: { 
                action: 'cpf_filter_data_cpt_movies', 
                keyword: keyword 
            },
            success: function(data) {
                jQuery('#datafetch').html( data );
            }
        });
    });
});