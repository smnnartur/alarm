jQuery(document).ready(function(){

    /*Check URL*/
    jQuery('#radio input').change(function(){
        if (jQuery(this).is(':checked') && jQuery(this).val() == 'user_yes') {
            jQuery("#user_url").show();
        }
        else {
            jQuery("#user_url").hide();
        }
    });
});