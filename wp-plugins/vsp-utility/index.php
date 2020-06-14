<?php
/**
 * Plugin Name: VSP Utility
 */

defined( 'QM_ENABLE_CAPS_PANEL' ) || define( 'QM_ENABLE_CAPS_PANEL', false );

add_filter( 'auth_cookie_expiration', 'vsp_extend_cookie_expairy' );
add_filter( 'heartbeat_settings', 'vsp_modify_heartbeat', 99, 1 );

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