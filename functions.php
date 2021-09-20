<?php
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'child-variable-style',   get_stylesheet_directory_uri() . '/css/variables.css',  ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-fonts-style',      get_stylesheet_directory_uri() . '/css/fonts.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-reset-style',      get_stylesheet_directory_uri() . '/css/reset.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-buttons-style',    get_stylesheet_directory_uri() . '/css/widgets/buttons.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-cart-style',       get_stylesheet_directory_uri() . '/css/widgets/cart.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-controls-style',   get_stylesheet_directory_uri() . '/css/widgets/controls.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-mini-cart-style',  get_stylesheet_directory_uri() . '/css/widgets/mini-cart.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-forms-style',      get_stylesheet_directory_uri() . '/css/widgets/forms.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-lightbox-style',   get_stylesheet_directory_uri() . '/css/widgets/lightbox.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-offices-style',    get_stylesheet_directory_uri() . '/css/widgets/offices.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-product-style',    get_stylesheet_directory_uri() . '/css/widgets/product.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-sidebar-style',    get_stylesheet_directory_uri() . '/css/widgets/sidebar.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-header-style',     get_stylesheet_directory_uri() . '/css/header.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-footer-style',     get_stylesheet_directory_uri() . '/css/footer.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-style',            get_stylesheet_directory_uri() . '/css/style.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-about-style',      get_stylesheet_directory_uri() . '/css/pages/about.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-mainpage-style',   get_stylesheet_directory_uri() . '/css/pages/mainpage.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-adaptive-style',   get_stylesheet_directory_uri() . '/css/adaptive.css',   ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_script( 'child-script',          get_stylesheet_directory_uri() . '/js/script.js',   ['flatsome-theme-woocommerce-js'] , '1.0', 'all' );
    wp_enqueue_script( 'child-product-card-script',get_stylesheet_directory_uri() . '/js/product-card.js',   ['flatsome-theme-woocommerce-js'] , '1.0', 'all' );
});

/*********
 * Single product page
 *********/

/**
 *  Remove additional information tab
 **/
add_filter( 'woocommerce_product_tabs', function ( $tabs ) {
    unset( $tabs['description'] );
    unset( $tabs['additional_information'] );
    return $tabs;
}, 100, 1 );


/**
 *  Add "additional information" after add to cart
 **/
add_action( 'woocommerce_single_product_summary', function () {
    global $product;
    wc_display_product_attributes( $product );
    if( strlen( $product->description ) > 20 ) echo '<div class="product-description"><p class="product-description-title">Description</p> ' . $product->description . '</div>';
}, 135 );

add_action( 'woocommerce_before_single_product', function () {
    ?>
    <h1 class="product-title product_title entry-title">
        <?php the_title(); ?>
    </h1> <?php
}, 135 );


/*
 * Shop | category page
 */
add_action( 'init', function () {

    add_action( 'woocommerce_archive_description', function ( ) {

        /**
         *  Show title on category | shop page
         **/
        $title = strtolower(trim(wp_title( '', false )));
        echo $title == 'products' ? '<h1>Shop</h1>' : '<h1>' . single_term_title( '', false ) . '</h1>';

        /**
         * subcategories list
         **/
        if ( is_product_category( ) ) {
            $taxonomy = 'product_cat';
            $parent_terms = get_ancestors( get_queried_object_id(), $taxonomy );

            if( sizeof( $parent_terms ) > 0 ) {
                $term_id  = sizeof( $parent_terms ) == 1 ? get_queried_object_id() : $parent_terms[0];
                // Get subcategories of the current category
                $terms = get_terms([
                    'taxonomy' => $taxonomy,
                    'hide_empty' => false,
                    'parent' => $term_id
                ]);
                echo '<ul class="subcategories-list">';
                // Loop through product subcategories WP_Term Objects
                foreach ($terms as $term) {
                    $active = $term->term_id == get_queried_object_id() ? 'is-active' : '';
                    $term_link = get_term_link($term, $taxonomy);
                    echo '<li class="' . $term->slug . '"><a href="' . $term_link . '" class="' . $active . '">' . $term->name . '</a></li>';
                }
                echo '</ul>';
            }
        }

    }, 135 );

    /**
     * hide shop title
     **/
    add_filter( 'woocommerce_page_title', function ( ) {
        return "";
    });
    /*
    // Remove result count.
    remove_action( 'flatsome_category_title_alt', 'woocommerce_result_count', 20 );
    // Remove ordering dropdown.
    remove_action( 'flatsome_category_title_alt', 'woocommerce_catalog_ordering', 30 );
    */
} );


/**
 *  The jQuery code that will handle the event getting the required  product data
 **/
add_action( 'wp_footer', 'added_to_cart_js_event' );
function added_to_cart_js_event(){
    ?>
    <script type="text/javascript">
        (function($){
            $(document.body).on('added_to_cart', function( event, fragments, cart_hash, button ) {
                button.attr('data-total', parseInt( button.data('total') ) + 1 );
                addedToCartNotification();
            });
        })(jQuery);
    </script>
    <?php
}

/**
 *  View cart button
 */
function woocommerce_widget_shopping_cart_button_view_cart() {
    echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward btn-outline">' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
}
/**
 *  Checkout button
 */
function woocommerce_widget_shopping_cart_proceed_to_checkout() {
    echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward btn-filled">' . esc_html__( 'Checkout', 'woocommerce' ) . '</a>';
}



/**
 * Change text strings
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function my_text_strings( $translated_text, $text, $domain ) {
    switch ( strtolower( $translated_text ) ) {
        case 'cart' :
            $translated_text = __( 'Shopping Cart', 'woocommerce' );
            break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );


/**
 * Added to cart from category
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
add_filter( 'woocommerce_loop_add_to_cart_link', function( $html, $product ) {
    if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
        $product_id = $product->get_id();
        $quantity = 0;
        foreach ( WC()->cart->get_cart() as $cart_item ) {
            if( $cart_item['product_id'] == $product_id) $quantity = $cart_item['quantity'];
        }

        $html = '<div class="add-to-cart-button"><a href="?add-to-cart=' . $product_id . '"  data-total="' . $quantity . '" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="' . $product_id . '" data-product_sku="" aria-label="' . $product->get_title() . '" rel="nofollow">Add to cart</a></div>';
    }
    return $html;
}, 10, 2 );