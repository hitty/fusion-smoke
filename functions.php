<?php
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'child-variable-style',   get_stylesheet_directory_uri() . '/css/variables.css',  ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-fonts-style',      get_stylesheet_directory_uri() . '/css/fonts.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-reset-style',      get_stylesheet_directory_uri() . '/css/reset.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-acc-item-style',    get_stylesheet_directory_uri() . '/css/widgets/account-item.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-bg-style',         get_stylesheet_directory_uri() . '/css/widgets/buttons.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-buttons-style',    get_stylesheet_directory_uri() . '/css/widgets/bg.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-cart-style',       get_stylesheet_directory_uri() . '/css/widgets/cart.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-controls-style',   get_stylesheet_directory_uri() . '/css/widgets/controls.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-chckt-brdcrmbs-style',get_stylesheet_directory_uri() . '/css/widgets/checkout-breadcrumbs.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-mini-cart-style',  get_stylesheet_directory_uri() . '/css/widgets/mini-cart.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-forms-style',      get_stylesheet_directory_uri() . '/css/widgets/forms.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-lightbox-style',   get_stylesheet_directory_uri() . '/css/widgets/lightbox.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-mfp-style',        get_stylesheet_directory_uri() . '/css/widgets/mfp.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-offices-style',    get_stylesheet_directory_uri() . '/css/widgets/offices.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-product-style',    get_stylesheet_directory_uri() . '/css/widgets/product.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-sidebar-style',    get_stylesheet_directory_uri() . '/css/widgets/sidebar.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-header-style',     get_stylesheet_directory_uri() . '/css/header.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-footer-style',     get_stylesheet_directory_uri() . '/css/footer.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-style',            get_stylesheet_directory_uri() . '/css/style.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-about-style',      get_stylesheet_directory_uri() . '/css/pages/about.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-cart-page-style',  get_stylesheet_directory_uri() . '/css/pages/cart.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-chckt-page-style', get_stylesheet_directory_uri() . '/css/pages/checkout.css',      ['flatsome-main', 'flatsome-shop'] , '1.0', 'all' );
    wp_enqueue_style( 'child-cntcts-page-style',get_stylesheet_directory_uri() . '/css/pages/contacts.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-dlvr-page-style',  get_stylesheet_directory_uri() . '/css/pages/delivery.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-mainpage-style',   get_stylesheet_directory_uri() . '/css/pages/mainpage.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-or-compl-style',   get_stylesheet_directory_uri() . '/css/pages/order-complete.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-shop-style',       get_stylesheet_directory_uri() . '/css/pages/shop.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-adaptive-style',   get_stylesheet_directory_uri() . '/css/adaptive.css',   ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_script( 'child-script',          get_stylesheet_directory_uri() . '/js/script.js',   [] , 'false', 'all' );
    wp_enqueue_script( 'child-product-card-script',get_stylesheet_directory_uri() . '/js/product-card.js',   [] , 'false', 'all' );
});

/******************
 * Single product page
 ******************/

/**
 *  Remove additional information tab
 **/
add_filter( 'woocommerce_product_tabs', function ( $tabs ) {
    unset( $tabs['description'] );
    unset( $tabs['additional_information'] );
    return $tabs;
}, 100, 1 );

/**
 *  Remove share tabs
 **/
remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);

/**
 *  Remove short description
 **/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

function woocommerce_template_single_excerpt() {
    return;
}
/**
 *  Add "additional information" after add to cart
 **/
add_action( 'woocommerce_single_product_summary', function () {
    global $product;
    wc_display_product_attributes( $product );

    if( strlen( $product->description ) > 20 || strlen( $product->short_description ) > 20 )
        echo "<p class='product-description-title'>Description</p>
            <div class='description-container'> 
                <div class='term-description product-description'>" . ( strlen( $product->description ) > 20 ? $product->description : $product->short_description ) . "</div>
                <span class='expand description-btns'>
                    Show all
                </span>
                <span class='hide description-btns'>Hide</span>
            </div>";

    woocommerce_template_single_sharing();
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

        if ( is_product_category( ) ) {

            /**
             * description
             **/
            remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

            $term = get_queried_object();
            $term = $term->term_id ?? 0;
            $description = get_term_field( 'description', $term );
            echo "<div class='description-container'> <div class='term-description product-description'>" . $description . "</div>
                    <span class='expand description-btns'>
                        Show all
                    </span>
                    <span class='hide description-btns'>Hide</span>
                  </div>";

            /**
             * subcategories list
             **/

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

    }, 2 );

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
        case 'billing details' :
            $translated_text = __( 'Shipping details', 'woocommerce' );
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


/**
 * Manage checkout fields
 *
 */
add_filter( 'woocommerce_checkout_fields' , function( $fields ) {
    $fields['billing']['billing_first_name']['placeholder'] = 'First name*';
    $fields['billing']['billing_last_name']['placeholder'] = 'Last name*';
    $fields['billing']['billing_company']['placeholder'] = 'Company name (optional)*';
    $fields['billing']['billing_address_2']['placeholder'] = 'Apartment';
    $fields['billing']['billing_city']['placeholder'] = 'Town / City*';
    $fields['billing']['billing_state']['placeholder'] = 'State / County (optional)';
    $fields['billing']['billing_phone']['placeholder'] = 'Phone*';
    $fields['billing']['billing_email']['placeholder'] = 'Email address*';
    $fields['order']['order_comments']['placeholder'] = 'Order notes (optional)';
    $fields['billing']['billing_postcode']['placeholder'] = 'Postcode / ZIP';
    $fields['billing']['billing_first_name']['label'] = $fields['billing']['billing_last_name']['label'] = $fields['billing']['billing_company']['label'] = $fields['billing']['billing_city']['label'] = $fields['billing']['billing_state']['label'] = $fields['billing']['billing_phone']['label'] = $fields['billing']['billing_email']['label'] = $fields['order']['order_comments']['label'] = $fields['billing']['billing_postcode']['label'] = '';

    return $fields;
});

function exclude_products_from_child_cats( $wp_query ) {
    if ( ! is_admin() && $wp_query->is_main_query()) {
        if (isset( $wp_query->query_vars['product_cat'] )) {
            $tax_query = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $wp_query->query_vars['product_cat'],
                    'include_children' => false
                )
            );
            $wp_query->set( 'tax_query', $tax_query );
        }
    }
}

add_filter( 'pre_get_posts', 'exclude_products_from_child_cats' );


/**
 * Shop type in category
 */
//Product Cat creation page
function text_domain_taxonomy_add_new_meta_field() {
    ?>
    <div class="form-field">
        <label for="term_meta[shop_category]"><?php _e('Category type', 'text_domain'); ?></label>
        <select name="term_meta[shop_category]" id="term_meta[shop_category]">
            <option value="">-- None --</option>
            <option class="level-0" value="1">Shop</option>
            <option class="level-0" value="2">Catering</option>
        </select>
        <p class="description"><?php _e('Shop or catering', 'text_domain'); ?></p>
    </div>
    <?php
}

add_action('product_cat_add_form_fields', 'text_domain_taxonomy_add_new_meta_field', 10, 2);

//Product Cat Edit page
function text_domain_taxonomy_edit_meta_field($term) {

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option("taxonomy_" . $term_id);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[shop_category]"><?php _e('Category type', 'text_domain'); ?></label></th>
        <td>
            <?php $shop_category = esc_attr($term_meta['shop_category']) ?? ''; ?>
            <select name="term_meta[shop_category]" id="term_meta[shop_category]">
                <option value="">-- None --</option>
                <option <?php if( $shop_category == 1 ) echo "selected='selected'" ;?> value="1">Shop</option>
                <option <?php if( $shop_category == 2 ) echo "selected='selected'" ;?> value="2">Catering</option>
            </select>
            <p class="description"><?php _e('Shop or catering', 'text_domain'); ?></p>
        </td>
    </tr>
    <?php
}

add_action('product_cat_edit_form_fields', 'text_domain_taxonomy_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta($term_id) {
    if (isset($_POST['term_meta'])) {
        $term_meta = get_option("taxonomy_" . $term_id);
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option("taxonomy_" . $term_id, $term_meta);
    }
}

add_action('edited_product_cat', 'save_taxonomy_custom_meta', 10, 2);
add_action('create_product_cat', 'save_taxonomy_custom_meta', 10, 2);