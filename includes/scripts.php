<?php
/**
 * Scripts
 *
 * @package     Woo Table Rate Shipping\Scripts
 * @since       1.0.0
 */


// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


/**
 * Load admin scripts
 *
 * @since       1.0.0
 * @global      array $edd_settings_page The slug for the Woo Table Rate Shipping settings page
 * @global      string $post_type The type of post that we are editing
 * @return      void
 */
function wpr_table_rate_admin_scripts( $hook ) {
    global $wptr_settings_page, $post_type;

    /**
     * @todo		This block loads styles or scripts explicitly on the
     *				Woo Table Rate Shipping settings page.
     */
    if ($hook == 'woocommerce_page_wc-settings') {

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-core' );

        wp_enqueue_style( 'thickbox' ); // call to media files in wp
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_script( 'media-upload' ); 

        wp_enqueue_script( 'wpr_table_rate_admin_js', WPTR_SHIPPING_URL . 'assets/js/admin.js', array( 'jquery' ) );
        wp_enqueue_style( 'wpr_table_rate_admin_css', WPTR_SHIPPING_URL . 'assets/css/admin.css' );
    }
}
add_action( 'admin_enqueue_scripts', 'wpr_table_rate_admin_scripts', 100 );


/**
 * Load frontend scripts
 *
 * @since       1.0.0
 * @return      void
 */
function wpr_table_rate_scripts( $hook ) {

    wp_enqueue_script( 'wpr_table_ratejs', WPTR_SHIPPING_URL . 'assets/js/scripts.js', array( 'jquery' ) );
    wp_enqueue_style( 'wpr_table_ratecss', WPTR_SHIPPING_URL . 'assets/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'wpr_table_rate_scripts' );
