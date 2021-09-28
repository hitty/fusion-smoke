<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

$row_classes     = array();
$main_classes    = array();
$sidebar_classes = array();

$auto_refresh  = get_theme_mod( 'cart_auto_refresh' );
$row_classes[] = 'row-large';
$row_classes[] = 'row-divided';

if ( $auto_refresh ) {
    $main_classes[] = 'cart-auto-refresh';
}


$row_classes     = implode( ' ', $row_classes );
$main_classes    = implode( ' ', $main_classes );
$sidebar_classes = implode( ' ', $sidebar_classes );


do_action( 'woocommerce_before_cart' ); ?>
<div class="woocommerce row">
    <div class="col large-8 pb-0 <?php echo $main_classes; ?>">

        <?php wc_print_notices(); ?>

        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <div class="cart-wrapper sm-touch-scroll">

                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                    <thead>
                    <tr>
                        <td class="product-thumbnail"><?php esc_html_e( 'Product', 'woocommerce' ); ?></td>
                        <td class="product-name"></td>
                        <td class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></td>
                        <td class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></td>
                        <td class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></td>
                        <td class="product-remove"></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                <td class="product-thumbnail">
                                    <?php
                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                    if ( ! $product_permalink ) {
                                        echo $thumbnail; // PHPCS: XSS ok.
                                    } else {
                                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                    }
                                    ?>
                                </td>

                                <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                    <?php
                                    if ( ! $product_permalink ) {
                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                    } else {
                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                    }

                                    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                    // Backorder notification.
                                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                    }

                                    // Mobile price.
                                    ?>
                                    <div class="show-for-small mobile-product-price">
                                        <span class="mobile-product-price__qty"><?php echo $cart_item['quantity']; ?> x </span>
                                        <?php
                                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                        ?>
                                    </div>
                                </td>

                                <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                    <?php
                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                                </td>

                                <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                    <?php
                                    if ( $_product->is_sold_individually() ) {
                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                    } else {
                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );
                                    }

                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                    ?>
                                </td>

                                <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                    <?php
                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                                </td>

                                <td class="product-remove">
                                    <?php
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.9643 15.2172C10.6286 15.2172 9.29294 15.2172 7.95342 15.2172C6.5681 15.2172 5.18279 15.2401 3.79747 15.2172H3.79366C3.77458 15.2172 3.75931 15.2172 3.74023 15.2172C3.65245 15.2096 3.67154 15.2134 3.78602 15.2286C3.78602 15.2325 3.67917 15.2057 3.6868 15.2096C3.64864 15.2019 3.60284 15.1752 3.56468 15.1752C3.47309 15.1676 3.71733 15.263 3.58376 15.1828C3.55705 15.1676 3.52652 15.1523 3.49599 15.1332C3.3357 15.0378 3.48454 15.1409 3.48835 15.137C3.48454 15.137 3.30517 14.9768 3.3128 14.9615C3.32044 14.95 3.4044 15.1141 3.33189 14.9768C3.3128 14.9386 3.28991 14.9043 3.27082 14.8699C3.19832 14.7402 3.29754 14.9119 3.28609 14.9157C3.27846 14.9157 3.24411 14.7821 3.24029 14.7707C3.23266 14.7402 3.23266 14.6982 3.22121 14.6715C3.28609 14.8432 3.23266 14.7402 3.23266 14.6638C3.23266 14.5799 3.23266 14.4959 3.23266 14.412C3.23266 13.8433 3.23266 13.2785 3.23266 12.7099C3.23266 10.8056 3.23266 8.90504 3.23266 7.00071C3.23266 5.71843 3.26319 4.42853 3.23266 3.14625C3.23266 3.12717 3.23266 3.10427 3.23266 3.08519C2.97697 3.34088 2.72509 3.59276 2.4694 3.84845C3.69062 3.84845 4.90802 3.84845 6.12923 3.84845C8.07172 3.84845 10.0142 3.84845 11.9529 3.84845C12.3956 3.84845 12.8383 3.84845 13.281 3.84845C13.0253 3.59276 12.7734 3.34088 12.5177 3.08519C12.5177 4.5621 12.5177 6.039 12.5177 7.51591C12.5177 9.63395 12.5177 11.752 12.5177 13.87C12.5177 14.1143 12.5177 14.3623 12.5177 14.6066C12.5177 14.6257 12.5177 14.6409 12.5177 14.66C12.5177 14.6791 12.5177 14.702 12.5177 14.7173C12.5215 14.8928 12.5635 14.5532 12.5215 14.7211C12.5177 14.7402 12.4795 14.9195 12.4681 14.9157C12.4795 14.8852 12.4948 14.8546 12.5063 14.8279C12.491 14.8585 12.4757 14.889 12.4605 14.9157C12.4566 14.9233 12.3879 15.0455 12.3803 15.0416C12.3994 15.0149 12.4185 14.992 12.4376 14.9653C12.4147 14.992 12.3956 15.0149 12.3727 15.0378C12.3498 15.0607 12.3269 15.0836 12.3002 15.1065C12.2391 15.1599 12.2506 15.1485 12.3383 15.0798C12.3422 15.0874 12.2239 15.1523 12.2124 15.1599C12.1819 15.1752 12.1552 15.1905 12.1246 15.2057C12.2315 15.1638 12.2429 15.1561 12.1666 15.1828C12.117 15.1943 12.0674 15.2096 12.0178 15.221C11.9338 15.2363 11.9491 15.2325 12.0674 15.2134C12.0369 15.2172 12.0025 15.2172 11.9643 15.2172C11.5636 15.2248 11.182 15.5645 11.2011 15.9804C11.2202 16.3888 11.5369 16.7513 11.9643 16.7437C13.113 16.7208 14.029 15.8087 14.048 14.66C14.0519 14.5226 14.048 14.3814 14.048 14.244C14.048 13.4044 14.048 12.5649 14.048 11.7253C14.048 9.40879 14.048 7.0923 14.048 4.77581C14.048 4.211 14.048 3.64619 14.048 3.08137C14.048 2.66921 13.6969 2.31812 13.2848 2.31812C12.0636 2.31812 10.8462 2.31812 9.62495 2.31812C7.68246 2.31812 5.73997 2.31812 3.80129 2.31812C3.3586 2.31812 2.91591 2.31812 2.47322 2.31812C2.06106 2.31812 1.70996 2.66921 1.70996 3.08137C1.70996 4.18428 1.70996 5.28719 1.70996 6.39392C1.70996 8.34404 1.70996 10.298 1.70996 12.2481C1.70996 12.9083 1.70996 13.5686 1.70996 14.2288C1.70996 14.3623 1.70996 14.4997 1.70996 14.6333C1.71378 15.2477 1.96947 15.8545 2.45032 16.2476C2.87011 16.5872 3.35097 16.7437 3.88906 16.7437C4.11423 16.7437 4.33939 16.7437 4.56073 16.7437C5.41558 16.7437 6.26662 16.7437 7.12147 16.7437C8.70523 16.7437 10.289 16.7437 11.8728 16.7437C11.9033 16.7437 11.9338 16.7437 11.9643 16.7437C12.3651 16.7437 12.7467 16.3926 12.7276 15.9804C12.7123 15.5683 12.3956 15.2172 11.9643 15.2172Z" fill="#747A8E"/>
                                                        <path d="M0.763945 3.81419C1.23717 3.81419 1.71039 3.81419 2.18361 3.81419C3.31323 3.81419 4.44285 3.81419 5.57629 3.81419C6.95016 3.81419 8.32402 3.81419 9.69789 3.81419C10.8809 3.81419 12.064 3.81419 13.247 3.81419C13.8233 3.81419 14.4034 3.82945 14.9796 3.81419C14.9873 3.81419 14.9949 3.81419 15.0025 3.81419C15.4032 3.81419 15.7849 3.46309 15.7658 3.05093C15.7467 2.63877 15.43 2.28767 15.0025 2.28767C14.5293 2.28767 14.0561 2.28767 13.5829 2.28767C12.4533 2.28767 11.3236 2.28767 10.1902 2.28767C8.81633 2.28767 7.44246 2.28767 6.06859 2.28767C4.88554 2.28767 3.70249 2.28767 2.51944 2.28767C1.94318 2.28767 1.3631 2.2724 0.786843 2.28767C0.779211 2.28767 0.771578 2.28767 0.763945 2.28767C0.363235 2.28767 -0.0183947 2.63877 0.000686722 3.05093C0.0159519 3.46309 0.332704 3.81419 0.763945 3.81419Z" fill="#747A8E"/>
                                                        <path d="M5.98436 3.0471C5.98436 2.79904 5.98436 2.54716 5.98436 2.2991C5.98436 2.14645 5.98436 1.9938 5.98436 1.84115C5.98436 1.79917 5.98436 1.76101 5.98436 1.71903C5.98436 1.71521 5.98436 1.70758 5.98436 1.70376C5.98436 1.67323 6.00344 1.60072 5.97673 1.69995C5.9462 1.82588 5.98817 1.66178 5.99199 1.65033C6.01871 1.5244 5.91948 1.75337 5.99199 1.64652C5.98817 1.65415 6.0416 1.55874 6.04542 1.56256C6.06068 1.57019 5.93475 1.67323 6.00344 1.6198C6.02634 1.60072 6.05687 1.57401 6.07213 1.55111C6.12556 1.48242 6.02252 1.60836 6.01489 1.59309C6.01489 1.58927 6.07213 1.55493 6.07977 1.55493C6.21334 1.48242 6.09121 1.57019 6.05687 1.55874C6.06832 1.56256 6.29729 1.49387 6.15609 1.52821C6.05687 1.55493 6.12938 1.53203 6.16372 1.53585C6.17517 1.53585 6.19044 1.53585 6.2057 1.53585C6.40033 1.53585 6.59878 1.53585 6.79341 1.53585C7.4689 1.53585 8.14056 1.53585 8.81605 1.53585C9.06029 1.53585 9.30453 1.53585 9.54496 1.53585C9.59076 1.53585 9.63655 1.53966 9.67853 1.53585C9.68235 1.53585 9.73196 1.53966 9.73578 1.53585C9.70143 1.57019 9.57931 1.5015 9.68616 1.53203C9.70906 1.53966 9.73578 1.5473 9.75867 1.55111C9.85408 1.56638 9.64037 1.47479 9.71669 1.53203C9.73578 1.5473 9.76249 1.55874 9.78157 1.56638C9.80065 1.57783 9.88079 1.60836 9.78539 1.56256C9.68998 1.51676 9.79302 1.57783 9.81973 1.60072C9.85026 1.62744 9.8579 1.67705 9.82355 1.60072C9.77394 1.49387 9.83118 1.62362 9.84645 1.64652C9.88461 1.70376 9.83882 1.69613 9.85026 1.64652C9.82737 1.58546 9.82355 1.58546 9.84645 1.65033C9.85026 1.6656 9.85408 1.68468 9.8579 1.69995C9.89988 1.83733 9.86171 1.55111 9.85408 1.70758C9.85408 1.71903 9.85408 1.73048 9.85408 1.73811C9.85408 1.88313 9.85408 2.02815 9.85408 2.16935C9.85408 2.46321 9.85408 2.75706 9.85408 3.05091C9.85408 3.45163 10.2052 3.83326 10.6173 3.81417C11.0295 3.79509 11.3806 3.47834 11.3806 3.05091C11.3806 2.76851 11.3806 2.48992 11.3806 2.20751C11.3806 1.81444 11.4035 1.42517 11.247 1.05499C10.9761 0.413856 10.3655 0.0169613 9.6709 0.00169613C9.48772 -0.00212016 9.30453 0.00169613 9.12135 0.00169613C8.39626 0.00169613 7.67116 0.00169613 6.94606 0.00169613C6.21715 0.00169613 5.44626 -0.0593646 4.90816 0.555059C4.62194 0.879444 4.46929 1.27252 4.46166 1.70376C4.45784 1.82207 4.46166 1.94419 4.46166 2.06249C4.46166 2.3907 4.46166 2.7189 4.46166 3.0471C4.46166 3.44781 4.81276 3.82944 5.22492 3.81036C5.63326 3.79509 5.98436 3.47834 5.98436 3.0471Z" fill="#747A8E"/>
                                                        <path d="M5.43164 6.6077C5.43164 8.30976 5.43164 10.0156 5.43164 11.7177C5.43164 11.962 5.43164 12.2062 5.43164 12.4543C5.43164 12.855 5.78274 13.2366 6.1949 13.2175C6.60706 13.1984 6.95816 12.8817 6.95816 12.4543C6.95816 10.7522 6.95816 9.04631 6.95816 7.34424C6.95816 7.1 6.95816 6.85575 6.95816 6.6077C6.95816 6.20698 6.60706 5.82536 6.1949 5.84444C5.78274 5.86352 5.43164 6.18027 5.43164 6.6077Z" fill="#747A8E"/>
                                                        <path d="M8.80469 6.6077C8.80469 8.30976 8.80469 10.0156 8.80469 11.7177C8.80469 11.962 8.80469 12.2062 8.80469 12.4543C8.80469 12.855 9.15579 13.2366 9.56795 13.2175C9.98011 13.1984 10.3312 12.8817 10.3312 12.4543C10.3312 10.7522 10.3312 9.04631 10.3312 7.34424C10.3312 7.1 10.3312 6.85575 10.3312 6.6077C10.3312 6.20698 9.98011 5.82536 9.56795 5.84444C9.15197 5.86352 8.80469 6.18027 8.80469 6.6077Z" fill="#747A8E"/>
                                                        </svg>
                                                </a>',
                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                            esc_html__( 'Remove this item', 'woocommerce' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $_product->get_sku() )
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </td>

                            </tr>
                            <?php
                        }
                    }
                    ?>

                    <?php do_action( 'woocommerce_cart_contents' ); ?>

                    <tr>
                        <td colspan="6" class="actions clear">

                            <?php do_action( 'woocommerce_cart_actions' ); ?>

                            <button type="submit" class="button primary mt-0 pull-left small" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                        </td>
                    </tr>

                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    </tbody>
                </table>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </div>
        </form>
    </div>

    <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

    <div class="cart-collaterals large-4 col pb-0">
        <?php flatsome_sticky_column_open( 'cart_sticky_sidebar' ); ?>

        <div class="cart-sidebar col-inner <?php echo $sidebar_classes; ?>">
            <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action( 'woocommerce_cart_collaterals' );
            ?>
            <?php if ( wc_coupons_enabled() ) { ?>
                <form class="checkout_coupon mb-0" method="post">
                    <div class="coupon">
                        <h3 class="widget-title"><?php echo get_flatsome_icon( 'icon-tag' ); ?> <?php esc_html_e( 'Coupon', 'woocommerce' ); ?></h3><input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="is-form expand" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" />
                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>
                </form>
            <?php } ?>
            <?php do_action( 'flatsome_cart_sidebar' ); ?>
        </div>

        <?php flatsome_sticky_column_close( 'cart_sticky_sidebar' ); ?>
    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
