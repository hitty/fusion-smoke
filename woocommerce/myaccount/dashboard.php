<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


?>
<?php
require_once dirname( __FILE__ ) . '/my-orders.php';
?>

	<div class="u-columns woocommerce-Addresses col2-set addresses">

        <div class="u-column2 col-2 woocommerce-account">
            <header class="woocommerce-Address-title title">
                <h3><?php echo esc_html( 'Account details' ); ?></h3>
                <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account', $name ) ); ?>" class="edit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.6066 3.5C14.7392 3.5 14.8664 3.55268 14.9602 3.64645L17.7886 6.47487C17.9838 6.67014 17.9838 6.98672 17.7886 7.18198L8.59619 16.3744C8.53337 16.4372 8.45495 16.4821 8.369 16.5046L4.54057 17.5046C4.36883 17.5494 4.18617 17.4999 4.06066 17.3744C3.93514 17.2489 3.88558 17.0662 3.93044 16.8945L4.93044 13.066C4.95289 12.9801 4.99784 12.9017 5.06066 12.8388L14.253 3.64645C14.3468 3.55268 14.474 3.5 14.6066 3.5Z" fill="#59D7CF"/>
                        <path d="M4 19.25C3.58579 19.25 3.25 19.5858 3.25 20C3.25 20.4142 3.58579 20.75 4 20.75H19C19.4142 20.75 19.75 20.4142 19.75 20C19.75 19.5858 19.4142 19.25 19 19.25H4Z" fill="#59D7CF"/>
                    </svg>
                </a>
            </header>
            <div class="account-card">
                <?php
                $current_user = wp_get_current_user();
                $user_id = $current_user->ID;
                ?>
                <div class="account-card-image">
                    <?php echo get_avatar( $user_id, 70 ); ?>

                </div>
                <div class="account-card-content">
                    <?php if( $current_user->first_name ) echo esc_attr( $current_user->first_name ) . '<br>'; ?>
                    <?php if( $current_user->last_name ) echo esc_attr( $current_user->last_name ) . '<br>'; ?>
                    <?php if( $current_user->user_email ) echo esc_attr( $current_user->user_email ) . '<br>'; ?>
                    <?php if( $current_user->user_phone ) echo esc_attr( $current_user->user_phone ) . '<br>'; ?>
                </div>
            </div>
        </div>

        <?php
		$address = wc_get_account_formatted_address( 'billing' );
		$col     = $col * -1;
		$oldcol  = $oldcol * -1;
		?>

		<div class="u-column2 col-2 woocommerce-Address <?php if(empty(!$address)){ ?> woocommerce-empty-results <?php ;} ?>">
			<header class="woocommerce-Address-title title">
				<h3><?php echo esc_html( 'Address' ); ?></h3>
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14.6066 3.5C14.7392 3.5 14.8664 3.55268 14.9602 3.64645L17.7886 6.47487C17.9838 6.67014 17.9838 6.98672 17.7886 7.18198L8.59619 16.3744C8.53337 16.4372 8.45495 16.4821 8.369 16.5046L4.54057 17.5046C4.36883 17.5494 4.18617 17.4999 4.06066 17.3744C3.93514 17.2489 3.88558 17.0662 3.93044 16.8945L4.93044 13.066C4.95289 12.9801 4.99784 12.9017 5.06066 12.8388L14.253 3.64645C14.3468 3.55268 14.474 3.5 14.6066 3.5Z" fill="#59D7CF"/>
						<path d="M4 19.25C3.58579 19.25 3.25 19.5858 3.25 20C3.25 20.4142 3.58579 20.75 4 20.75H19C19.4142 20.75 19.75 20.4142 19.75 20C19.75 19.5858 19.4142 19.25 19 19.25H4Z" fill="#59D7CF"/>
					</svg>

				</a>
			</header>
			<address>
				<?php
				echo $address ? wp_kses_post( $address ) : 'No adresses yet.<br><a href="/my-account/edit-address/">Add adress</a>';
				?>
			</address>
		</div>




	</div>

