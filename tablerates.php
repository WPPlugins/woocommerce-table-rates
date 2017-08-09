<?php
/**
 * Plugin Name: WooCommerce - Table Rates
 * Plugin URI: http://wp-ronin.com
 * Description: Plugin for fixed rate shipping depending upon the cart amount in WooCommerce.
 * Version: 1.6.0
 * Author: WP Ronin
 * Author URI: http://ryanpletcher.com
 * License: GPL2
 * Text Domain:     rptr
 *
 *
 *
 * 
 * @package         Woocommerce-Table-Rates
 * @author          Ryan Pletcher
 * @copyright       Copyright (c) 2015
 *
 */


// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'WPR_Table_Rate' ) ) {

    /**
     * Main WPR_Table_Rate class
     *
     * @since       1.0.0
     */
    class WPR_Table_Rate {

        /**
         * @var         WPR_Table_Rate $instance The one true WPR_Table_Rate
         * @since       1.0.0
         */
        private static $instance;
        
        /**
         * Get active instance
         *
         * @access      public
         * @since       1.0.0
         * @return      object self::$instance The one true WPR_Table_Rate
         */
        public static function instance() {
            if( !self::$instance ) {
                self::$instance = new WPR_Table_Rate();
                self::$instance->setup_constants();
                self::$instance->includes();
                self::$instance->load_textdomain();
                self::$instance->hooks();
            }

            return self::$instance;
        }


        /**
         * Setup plugin constants
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function setup_constants() {
            define( 'WPTR_SHIPPING_VER', '1.5.0' );  // Plugin version
            
            define( 'WPTR_SHIPPING_DIR', plugin_dir_path( __FILE__ ) );  // Plugin path

            define( 'WPTR_SHIPPING_URL', plugin_dir_url( __FILE__ ) );  // Plugin URL
        }


        /**
         * Include necessary files
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function includes() {
            // Include scripts
            require_once WPTR_SHIPPING_DIR . 'includes/scripts.php';
            require_once WPTR_SHIPPING_DIR . 'includes/functions.php';
            require_once WPTR_SHIPPING_DIR . 'includes/class.tablerate.php';

            // require_once WPTR_SHIPPINGDIR . 'includes/shortcodes.php';
            // require_once WPTR_SHIPPINGDIR . 'includes/widgets.php';
        }


        /**
         * Run action and filter hooks
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         *
         */
        private function hooks() {
            // Register settings

           add_filter( 'woocommerce_shipping_methods', array( $this, 'add_table_rate_rp' ) );
           add_action( 'wp_ajax_wpr_tr_add_row', array( 'WPR_TR_Ajax', 'add_row' ) );

        }

        public function add_table_rate_rp( $methods ) {
            $methods[] = 'rp_tablerates';

            return $methods;
        }

        /**
         * Internationalization
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function load_textdomain() {
            // Set filter for language directory
            $lang_dir = WPTR_SHIPPING_DIR . '/languages/';
            $lang_dir = apply_filters( 'wpr_table_rate_languages_directory', $lang_dir );

            // Traditional WordPress plugin locale filter
            $locale = apply_filters( 'plugin_locale', get_locale(), 'rptr' );
            $mofile = sprintf( '%1$s-%2$s.mo', 'rptr', $locale );

            // Setup paths to current locale file
            $mofile_local   = $lang_dir . $mofile;
            
            if( file_exists( $mofile_local ) ) {
                // Look in local /wp-content/plugins/wpr-table-rate/languages/ folder
                load_textdomain( 'wpr-table-rate', $mofile_local );
            } else {
                // Load the default language files
                load_plugin_textdomain( 'wpr-table-rate', false, $lang_dir );
            }
        }

        /**
         * If Woocommerce is not installed, show a notice
         * @return void
         */
        public function no_woo_nag() {
             // We need plugin.php!
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            
            $plugins = get_plugins();
            
            // Set plugin directory
            $plugin_path = array_filter( explode( '/', $plugin_path ) );
            $this->plugin_path = end( $plugin_path );
            
            // Set plugin file
            $this->plugin_file = $plugin_file;
            
            // Set plugin name
            $this->plugin_name = 'WooCommerce - Table Rates';
            
            // Is EDD installed?
            foreach( $plugins as $plugin_path => $plugin ) {
                
                if( $plugin['Name'] == 'WooCommerce' ) {
                    $this->has_woo = true;
                    $this->wpr_base = $plugin_path;
                    break;
                }
            }

            if( $this->has_woo ) {
                $url  = esc_url( wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=' . $this->wpr_base ), 'activate-plugin_' . $this->wpr_base ) );
                $link = '<a href="' . $url . '">' . __( 'activate it', 'rptr' ) . '</a>';
            } else {
                $url  = esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) );
                $link = '<a href="' . $url . '">' . __( 'install it', 'rptr' ) . '</a>';
            }
            
            echo '<div class="error"><p>' . $this->plugin_name . sprintf( __( ' requires WooCommerce! Please %s to continue!', 'rptr' ), $link ) . '</p></div>';
        }


        /**
         * Add settings
         *
         * @access      public
         * @since       1.0.0
         * @param       array $settings The existing EDD settings array
         * @return      array The modified EDD settings array
         */
        public function settings( $settings ) {
            $new_settings = array(
                array(
                    'id'    => 'wpr_table_ratesettings',
                    'name'  => '<strong>' . __( 'Plugin Name Settings', 'rptr' ) . '</strong>',
                    'desc'  => __( 'Configure Plugin Name Settings', 'rptr' ),
                    'type'  => 'header',
                )
            );

            return array_merge( $settings, $new_settings );
        }


    }
} // End if class_exists check


/**
 * The main function responsible for returning the one true WPR_Table_Rate
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \WPR_Table_Rate The one true WPR_Table_Rate
 *
 * @todo        Inclusion of the activation code below isn't mandatory, but
 *              can prevent any number of errors, including fatal errors, in
 *              situations where your extension is activated but EDD is not
 *              present.
 */
function WPR_Table_Rate_load() {

    if( ! class_exists( 'WooCommerce' ) ) {
        if( ! class_exists( 'WPR_Tablerate_Activation' ) ) {
            require_once 'includes/class.activation.php';
        }

        $activation = new WPR_Tablerate_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
        $activation = $activation->run();
        
        //return WPRWooGiftcards::instance();
    } else {
        return WPR_Table_Rate::instance();
    }

    

}
add_action( 'plugins_loaded', 'WPR_Table_Rate_load' );


/**
 * The activation hook is called outside of the singleton because WordPress doesn't
 * register the call from within the class, since we are preferring the plugins_loaded
 * hook for compatibility, we also can't reference a function inside the plugin class
 * for the activation function. If you need an activation function, put it here.
 *
 * @since       1.0.0
 * @return      void
 */
function wpr_table_rateactivation() {
    /* Activation functions here */
}
register_activation_hook( __FILE__, 'wpr_table_rateactivation' );
