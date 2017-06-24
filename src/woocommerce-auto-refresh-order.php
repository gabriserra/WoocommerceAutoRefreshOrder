<?php
/**
 * Plugin Name: WooCommerce Auto Refresh Order Page
 * Plugin URI: https://github.com/gabriserra/woocommerce-auto-refresh-order
 * Description: The plugin permit to refresh the admin order page automatically
 * Author: Gabriele Serra
 * Author URI: https://github.com/gabriserra
 * Version: 0.1
 */

// Try to prevent direct access data leaks
 if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }

class WC_Auto_Refresh_Order {

    /**
     * Bootstraps the class and hooks required actions & filters.
     *
     */
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_auto_refresh', __CLASS__ . '::wc_get_settings_tab' );
        add_action( 'woocommerce_update_options_auto_refresh', __CLASS__ . '::wc_update_settings_tab' );
        add_action( 'admin_head', __CLASS__ . '::add_refresh_tag' );
    }

    /**
     * Uses the WooCommerce admin fields API to output settings
     * via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    public static function wc_get_settings_tab() {
        woocommerce_admin_fields( self::get_settings() );
    }

    /**
     * Uses the WooCommerce options API to save settings
     * via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    public static function wc_update_settings_tab() {
        woocommerce_update_options( self::get_settings() );
    }


    /**
     * Add a new settings tab to the WooCommerce settings tabs array.
     *
     * @param array $settings_tabs
     * Array of WooCommerce setting tabs & their labels
     *
     * @return array $settings_tabs
     * Array of WooCommerce setting tabs & their labels,
     * including the auto refresh tab.
     */
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['auto_refresh'] = __( 'Auto Refresh', 'woocommerce-auto-refresh' );
        return $settings_tabs;
    }

    /**
     * Get all the settings for this plugin
     * @see woocommerce_admin_fields() function.
     *
     * @return array Array of settings
     * for @see woocommerce_admin_fields() function.
     */
    public static function get_settings() {
        $settings = array(
            'section_title' => array(
                'name'     => __( 'Opzioni auto refresh', 'woocommerce-auto-refresh' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc_auto_refresh_section_title'
            ),
            'enabled' => array(
                'name' => __( 'Abilitato', 'woocommerce-auto-refresh' ),
                'type' => 'checkbox',
                'desc' => __( 'Abilita auto refresh', 'woocommerce-auto-refresh' ),
                'id'   => 'wc_auto_refresh_enable'
            ),
            'seconds' => array(
                'name' => __( 'Secondi', 'woocommerce-auto-refresh' ),
                'type' => 'text',
                'desc' => __( 'Secondi dopo i quali la pagina verrà aggiornata ', 'woocommerce-auto-refresh' ),
                'id'   => 'wc_auto_refresh_seconds'
            ),
            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wc_auto_refresh_section_end'
            )
        );
        return apply_filters( 'wc_auto_refresh_settings', $settings );
    }

    /**
     * Add refresh meta tag to HTML
     * @see $pagenow global variable.
     *
     */
    public static function add_refresh_tag() {
        global $pagenow;

        // Current page is not the edit one!
        if($pagenow != 'edit.php')
          return;

        // Current page is not the order one!
        if(!isset($_GET['post_type']) && $_GET['post_type'] != 'shop_order')
          return;

        // Auto refresh is not enabled!
        $enable = get_option( 'wc_auto_refresh_enable' );
        if($enable == false)
          return;

        // Add head meta tag
        $seconds = get_option( 'wc_auto_refresh_seconds' );
        if (intval($seconds) && intval($seconds > 0)) {
    		   echo '<meta http-equiv="refresh" content="' . $seconds . '" />';
    	  }
    }
}

WC_Auto_Refresh_Order::init();
