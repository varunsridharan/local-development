<?php
/**
 * Plugin Name: Remove WP Dashboard Widgets
 */
add_action( 'wp_dashboard_setup', 'vsp_dev_remove_dashboard_widgets', 9999, 1000 );

remove_action( 'welcome_panel', 'wp_welcome_panel' );

if ( ! function_exists( 'vsp_dev_remove_dashboard_widgets' ) ) {
	/**
	 * Removes All default Dashboard Widgets.
	 *
	 * @since {NEWVERSION}
	 */
	function vsp_dev_remove_dashboard_widgets() {
		global $wp_registered_widgets, $wp_meta_boxes;
		if ( isset( $wp_meta_boxes['dashboard'] ) ) {
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health'] );
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
		}
	}
}