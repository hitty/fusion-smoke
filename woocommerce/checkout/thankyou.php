<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>

<div class="row">

    <?php if ($order) :

        do_action('woocommerce_before_thankyou', $order->get_id()); ?>

        <?php if ($order->has_status('failed')) : ?>
        <div class="large-12 col order-failed">
            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
                   class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                       class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                <?php endif; ?>
            </p>
        </div>

    <?php else : ?>
        <div class="col">
            <div class="is-well col-inner entry-content">
                <div class="success-color woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="woocommerce-thankyou-order-received-icon" >
                        <circle cx="50.3176" cy="50.3184" r="47.7707" fill="#93DE8D"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M75.3712 33.3994C76.5916 34.6198 76.5916 36.5985 75.3712 37.8188L46.2045 66.9855C44.9841 68.2059 43.0055 68.2059 41.7851 66.9855L25.1184 50.3188C23.898 49.0985 23.898 47.1198 25.1184 45.8994C26.3388 44.679 28.3174 44.679 29.5378 45.8994L43.9948 60.3564L70.9518 33.3994C72.1721 32.179 74.1508 32.179 75.3712 33.3994Z"
                              fill="white"/>
                    </svg>

                    <div>
                    Your order has been successfully completed.<br>
                    Expect delivery soon, if you have any questions, you can always <a href="/contact/">contact us</a>.<br>
                    Your order information will be in <a href="/my-account/orders/">your profile</a>.
                    </div>
                </div>

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
                        <strong><?php echo $order->get_status();?></strong>
                    </li>
                    <li class="woocommerce-order-overview__address address ">
                        <?php esc_html_e('Address:', 'woocommerce'); ?>
                        <strong><?php echo $order->get_billing_address_1( ) . ', ' . $order->get_billing_city(); ?></strong>
                    </li>
                    <li class="woocommerce-order-overview__count count ">
                        <?php esc_html_e('Items:', 'woocommerce'); ?>
                        <strong><?php echo count($order->get_items()); ?></strong>
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

                <div class="clear"></div>
            </div>
        </div>

        <div class="col">

            <?php
            $get_payment_method = $order->get_payment_method();
            $get_order_id = $order->get_id();
            ?>
            <?php do_action('woocommerce_thankyou_' . $get_payment_method, $get_order_id); ?>

        </div>

    <?php endif; ?>

    <?php else : ?>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

    <?php endif; ?>

    <div class="large-12 col ">
        <a href="/shop/" class="btn btn-outline">
            <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 12px">
                <path d="M7.5 1L1.5 7L7.5 13" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            Continue shoping</a>

    </div>
