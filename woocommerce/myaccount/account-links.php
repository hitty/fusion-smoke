<?php if ( has_nav_menu( 'my_account' ) ) { ?>

  <?php
    echo wp_nav_menu(array(
      'theme_location' => 'my_account',
      'container' => false,
      'items_wrap' => '%3$s',
      'depth' => 0,
      'walker' => new FlatsomeNavSidebar
    ));
  ?>
<?php } else if(!get_theme_mod('wc_account_links', 1)) { ?>
    <li>Define your My Account dropdown menu in <b>Appearance > Menus</b> or enable default WooCommerce Account Endpoints.</li>
<?php } ?>

<?php if(function_exists('wc_get_account_menu_items') && get_theme_mod('wc_account_links', 1)){ ?>
  <?php do_action('flatsome_account_links'); ?>
  <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
    <a href="<?php echo esc_url( wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' )) ); ?>"><?php _e('Logout','woocommerce'); ?></a>
  </li>
<?php } ?>
