<?php
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'child-variable-style',   get_stylesheet_directory_uri() . '/css/variables.css',  ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-fonts-style',      get_stylesheet_directory_uri() . '/css/fonts.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-reset-style',      get_stylesheet_directory_uri() . '/css/reset.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-buttons-style',    get_stylesheet_directory_uri() . '/css/widgets/buttons.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-forms-style',      get_stylesheet_directory_uri() . '/css/widgets/forms.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-lightbox-style',      get_stylesheet_directory_uri() . '/css/widgets/lightbox.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-product-style',      get_stylesheet_directory_uri() . '/css/widgets/product.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-sidebar-style',      get_stylesheet_directory_uri() . '/css/widgets/sidebar.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-header-style',     get_stylesheet_directory_uri() . '/css/header.css',      ['flatsome-main'] , '1.0', 'all' );
    wp_enqueue_style( 'child-footer-style',     get_stylesheet_directory_uri() . '/css/footer.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-style',            get_stylesheet_directory_uri() . '/css/style.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-mainpage-style',   get_stylesheet_directory_uri() . '/css/pages/mainpage.css',      ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_style( 'child-adaptive-style',   get_stylesheet_directory_uri() . '/css/adaptive.css',   ['flatsome-main'] , '1.0', 'all' );

    wp_enqueue_script( 'child-script',   get_stylesheet_directory_uri() . '/js/script.js',   ['flatsome-theme-woocommerce-js'] , '1.0', 'all' );
});

/*
 * Single product page
 */

// Remove additional information tab
add_filter( 'woocommerce_product_tabs', function ( $tabs ) {
    unset($tabs['additional_information']);
    return $tabs;
}, 100, 1 );


// Add "additional information" after add to cart
add_action( 'woocommerce_single_product_summary', function () {
    global $product;
    wc_display_product_attributes( $product );
}, 135 );


/*
 * Shop | category page
 */
add_action( 'init', function () {

    add_action( 'woocommerce_archive_description', function ( ) {

        // Show title on category | shop page
        $title = strtolower(trim(wp_title( '', false )));
        echo $title == 'products' ? '<h1>Shop</h1>' : '<h1>' . single_term_title( '', false ) . '</h1>';

        //subcategories list
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

    //hide shop title
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