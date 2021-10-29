<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined('ABSPATH') || exit;
?>
<div class="row">


    <div class="col">
        <div class="is-well col-inner entry-content">
            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                <li class="woocommerce-order-overview__order order">
                    <?php esc_html_e('Order number:', 'woocommerce'); ?>
                    <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                </li>

                <li class="woocommerce-order-overview__date date">
                    <?php esc_html_e('Date:', 'woocommerce'); ?>
                    <strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                </li>

                <?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
                    <li class="woocommerce-order-overview__email email">
                        <?php esc_html_e('Email:', 'woocommerce'); ?>
                        <strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                    </li>
                <?php endif; ?>


                <li class="woocommerce-order-overview__status status ">
                    <?php esc_html_e('Status:', 'woocommerce'); ?>
                    <strong><?php echo $order->get_status(); ?></strong>
                </li>
                <li class="woocommerce-order-overview__address address ">
                    <?php esc_html_e('Address:', 'woocommerce'); ?>
                    <strong><?php echo $order->get_billing_address_1() . ', ' . $order->get_billing_city(); ?></strong>
                </li>
                <li class="woocommerce-order-overview__phone phone">
                    <?php esc_html_e('Phone:', 'woocommerce'); ?>
                    <strong><?php echo $order->get_billing_phone(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                </li>
                <li class="woocommerce-order-overview__count count ">
                    <?php esc_html_e('Items:', 'woocommerce'); ?>
                    <strong><?php echo count($order->get_items()); ?></strong>
                    <div class="pseudo-link woocommerce-order-overview__count-link">View
                        <div class="woocommerce-order-overview__items-list">
                            <?php
                            $items = $order->get_items();
                            foreach ($items as $k => $item) {
                                echo "<span>" . $item->get_name() . " x " . $item->get_quantity() . "</span>";
                            }
                            ?>
                        </div>
                    </div>
                </li>

                <?php
                $payment_method_title = $order->get_payment_method_title();
                if ($payment_method_title) :
                    ?>
                    <li class="woocommerce-order-overview__payment-method method">
                        <?php esc_html_e('Payment method:', 'woocommerce'); ?>
                        <strong><?php echo wp_kses_post($payment_method_title); ?></strong>
                    </li>
                <?php endif; ?>

                <?php
                ?>
                <li class="woocommerce-order-overview__total total">
                    <?php esc_html_e('Total:', 'woocommerce'); ?>
                    <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                </li>

            </ul>
        </div>
    </div>
</div>

