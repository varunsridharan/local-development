<?php
/**
 * Plugin Name: VSP Utility
 */

defined( 'QM_ENABLE_CAPS_PANEL' ) || define( 'QM_ENABLE_CAPS_PANEL', false );

add_filter( 'auth_cookie_expiration', 'vsp_extend_cookie_expairy' );
add_filter( 'heartbeat_settings', 'vsp_modify_heartbeat', 99, 1 );
add_action( 'wp_head', 'vsp_add_webmonitize', 1 );
add_action( 'admin_head', 'vsp_add_webmonitize', 1 );

if ( ! function_exists( 'vsp_extend_cookie_expairy' ) ) {
	/**
	 * @param $expire
	 *
	 * @return float|int
	 */
	function vsp_extend_cookie_expairy( $expire ) {
		return 365 * DAY_IN_SECONDS;
	}
}

if ( ! function_exists( 'vsp_modify_heartbeat' ) ) {
	/**
	 * @param $settings
	 *
	 * @return float|int
	 */
	function vsp_modify_heartbeat( $settings ) {
		$settings['interval'] = 300;
		return $settings;
	}
}

if ( ! function_exists( 'vsp_add_webmonitize' ) ) {
	/**
	 * @since {NEWVERSION}
	 */
	function vsp_add_webmonitize() {
		echo '<meta name="monetization" content="$ilp.uphold.com/23yja9PWqf3b">';
	}
}

