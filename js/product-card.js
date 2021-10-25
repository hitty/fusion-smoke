// Ajax add to cart on the product page
var $warp_fragment_refresh = {
    url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
    type: 'POST',
    success: function( data ) {
        if ( data && data.fragments ) {

            jQuery.each( data.fragments, function( key, value ) {
                jQuery( key ).replaceWith( value );
            });

            jQuery( document.body ).trigger( 'wc_fragments_refreshed' );

            jQuery('.single_add_to_cart_button').removeClass('loading')
            addedToCartNotification();

        }
    }
};

jQuery('.entry-summary form.cart').on('submit', function (e)
{
    e.preventDefault();

    var product_url = window.location,
        form = jQuery(this);

    jQuery.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result)
    {
        var cart_dropdown = jQuery('.widget_shopping_cart', result)

        // update dropdown cart
        jQuery('.widget_shopping_cart').replaceWith(cart_dropdown);

        // update fragments
        jQuery.ajax($warp_fragment_refresh);

        jQuery('.entry-summary').unblock();

    });
});

function addedToCartNotification(){
    jQuery('<div id="cart-added-notification">Added to cart</div>').insertBefore('.cart-item');
    setTimeout(function(){
        jQuery('#cart-added-notification').fadeOut(300, function() { jQuery(this).remove(); });
    }, 1500);

}