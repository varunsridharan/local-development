<?php

if ( ! class_exists( 'VSP_Local_WP_Handler' ) ) {
	/**
	 * Class VSP_Local_WP_Handler
	 *
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 */
	class VSP_Local_WP_Handler {
		/**
		 * Stores An Array of plugins to be copied.
		 *
		 * @var array
		 * @example  array(template_path => new_path)
		 */
		protected $plugins_copy = array();

		/**
		 * Stores An Array of plugins to be copied.
		 *
		 * @var array
		 * @example  array(template_path => new_path)
		 */
		protected $mu_plugins_copy = array();

		/**
		 * VSP_Local_WP_Handler constructor.
		 *
		 * @uses setup_smtp_info
		 */
		public function __construct() {
			add_action( 'phpmailer_init', array( &$this, 'setup_smtp_info' ) );

			$this->plugins_copy = array(
				VSP_LOCAL_DIR . 'wp-plugins/query-monitor'                   => 'wp-content/plugins/query-monitor/query-monitor.php',
				VSP_LOCAL_DIR . 'wp-plugins/woo-preview-emails'              => 'wp-content/plugins/woo-preview-emails/woocommerce-preview-emails.php',
				VSP_WP_LOCAL_TEMPLATE . 'wp-content/plugins/test-plugin.php' => 'wp-content/plugins/test-plugin.php',
			);

			$this->mu_plugins_copy = array(
				VSP_LOCAL_DIR . 'wp-plugins/query-monitor-extend' => 'wp-content/mu-plugins/query-monitor-extend/query-monitor-extend.php',
				VSP_LOCAL_DIR . 'wp-plugins/theme-inspector'      => 'wp-content/mu-plugins/theme-inspector/theme-inspector.php',
				VSP_LOCAL_DIR . 'wp-plugins/pi-for-wc'            => 'wp-content/mu-plugins/pi-for-wc/wc-performance-improvements.php',
				VSP_LOCAL_DIR . 'wp-plugins/classic-editor'       => 'wp-content/mu-plugins/classic-editor/classic-editor.php',
				VSP_LOCAL_DIR . 'wp-plugins/wordpress-importer'   => 'wp-content/mu-plugins/wordpress-importer/wordpress-importer.php',
				VSP_LOCAL_DIR . 'wp-plugins/user-switching'       => 'wp-content/mu-plugins/user-switching/user-switching.php',
				VSP_LOCAL_DIR . 'wp-plugins/inspector'            => 'wp-content/mu-plugins/inspector/inspector.php',
				'debug-quick-look'                                => 'wp-content/mu-plugins/debug-quick-look/debug-quick-look.php',
			);

			$this->handle_debug_log_file();
		}

		/**
		 * Updates SMTP Infomration With WordPress To Work With Local SMTP Server.
		 *
		 * @param $phpmailer
		 */
		public function setup_smtp_info( $phpmailer ) {
			if ( defined( 'LOCAL_SMTP_HOST' ) ) {
				$phpmailer->Host = LOCAL_SMTP_HOST; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			}
			if ( defined( 'LOCAL_SMTP_PORT' ) ) {
				$phpmailer->Port = LOCAL_SMTP_PORT; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			}
			if ( defined( 'LOCAL_SMTP_AUTH' ) ) {
				$phpmailer->SMTPAuth = LOCAL_SMTP_AUTH; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			}
			if ( defined( 'LOCAL_SMTP_UERNAME' ) ) {
				$phpmailer->Username = LOCAL_SMTP_UERNAME; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			}
			if ( defined( 'LOCAL_SMTP_PASSWORD' ) ) {
				$phpmailer->Password = LOCAL_SMTP_PASSWORD; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			}

			if ( defined( 'LOCAL_SMTP_HOST' ) && defined( 'LOCAL_SMTP_PORT' ) ) {
				$phpmailer->isSMTP();
			}
		}

		/**
		 * Handles Debug Log File.
		 */
		protected function handle_debug_log_file() {
			$ctime    = date( 'D-d-M-Y-h-i-s-a' );
			$old_file = ABSPATH . 'wp-content/debug.log';
			$size     = ( file_exists( $old_file ) ) ? filesize( $old_file ) : 0;
			if ( $size >= WP_DEBUG_MAX_SIZE ) {
				@mkdir( ABSPATH . 'wp-content/' . WP_DEBUG_LOG_OVERFLOW_STORAGE . '/' );
				copy( $old_file, ABSPATH . 'wp-content/' . WP_DEBUG_LOG_OVERFLOW_STORAGE . '/' . $ctime . '.log' );
				@file_put_contents( ABSPATH . 'wp-content/debug.log', '' );
			}
		}
	}
}