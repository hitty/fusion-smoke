<?php
$is_facebook_login = is_nextend_facebook_login();
$is_google_login   = is_nextend_google_login();

$login_text     = get_theme_mod( 'facebook_login_text' );
$login_bg_image = get_theme_mod( 'facebook_login_bg', '' );
$login_bg_color = get_theme_mod( 'my_account_title_bg_color', '' );

if ( $login_bg_image ) $css_login_bg_args[] = array(
	'attribute' => 'background-image',
	'value'     => 'url(' . do_shortcode( $login_bg_image ) . ')',
);
if ( $login_bg_color ) $css_login_bg_args[] = array(
	'attribute' => 'background-color',
	'value'     => $login_bg_color,
);

global $wp;
$endpoint_label = '';
$current_url    = home_url( $wp->request );

// Collect current WC endpoint label.
if ( function_exists( 'wc_get_account_menu_items' ) && get_theme_mod( 'wc_account_links', 1 ) ) {
	foreach ( wc_get_account_menu_items() as $endpoint => $label ) {
		if ( untrailingslashit( wc_get_account_endpoint_url( $endpoint ) ) === $current_url ) {
			$endpoint_label = $label;
			break;
		}
	}
}
?>

<div class="my-account-header page-title normal-title">
    <div class="page-title-inner flex-row container	 text-left">
        <div class="account-user circle">
        <span class="image mr-half inline-block">
        <?php
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        echo get_avatar( $user_id, 70 );
        ?>
            </span>
            <span class="user-name inline-block">
            Hello, <?php
                echo $current_user->display_name;
                ?>
        </span>

            <?php do_action('flatsome_after_account_user'); ?>
        </div>
    </div>
</div>
