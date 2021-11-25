<?php
/**
 * My Orders - Deprecated
 *
 * @deprecated 2.6.0 this template file is no longer used. My Account shortcode uses orders.php.
 * @package WooCommerce\Templates
 */

defined( 'ABSPATH' ) || exit;

$my_orders_columns = apply_filters(
	'woocommerce_my_account_my_orders_columns',
	array(
		'order-number'  => esc_html__( 'Order', 'woocommerce' ),
		'order-date'    => esc_html__( 'Date', 'woocommerce' ),
		'order-status'  => esc_html__( 'Status', 'woocommerce' ),
		'order-total'   => esc_html__( 'Total', 'woocommerce' ),
		'order-actions' => '&nbsp;',
	)
);

$customer_orders = get_posts(
	apply_filters(
		'woocommerce_my_account_my_orders_query',
		array(
			'numberposts' => $order_count,
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_type'   => wc_get_order_types( 'view-orders' ),
			'post_status' => array_keys( wc_get_order_statuses() ),
		)
	)
);

if ( $customer_orders ) : ?>

	<h3><?php echo apply_filters( 'woocommerce_my_account_my_orders_title', esc_html__( 'Recent orders', 'woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
    <?php
    foreach ( $customer_orders as $customer_order ) :
        $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        $item_count = $order->get_item_count();

        // Backwards compatibility.
        $status       = new stdClass();
        $status->name = wc_get_order_status_name( $order->get_status() );

        wc_get_template(
            'myaccount/view-order.php',
            array(
                'status'   => $status, // @deprecated 2.2.
                'order'    => $order,
                'order_id' => $order->get_id(),
            )
        );

        ?>
    <?php endforeach; ?>
<?php endif; ?>
