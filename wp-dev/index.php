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
				VSP_WP_LOCAL_TEMPLATE . 'wp-content/plugins/query-monitor'      => 'wp-content/plugins/query-monitor/query-monitor.php',
				VSP_WP_LOCAL_TEMPLATE . 'wp-content/plugins/woo-preview-emails' => 'wp-content/plugins/woo-preview-emails/woocommerce-preview-emails.php',
				VSP_WP_LOCAL_TEMPLATE . 'wp-content/plugins/test-plugin.php'    => 'wp-content/plugins/test-plugin.php',
			);

			$this->mu_plugins_copy = array(
				VSP_LOCAL_DIR . 'wp-plugins/query-monitor-extend'               => 'wp-content/mu-plugins/query-monitor-extend/query-monitor-extend.php',
				VSP_LOCAL_DIR . 'wp-plugins/theme-inspector'                    => 'wp-content/mu-plugins/theme-inspector/theme-inspector.php',
				VSP_WP_LOCAL_TEMPLATE . 'wp-content/plugins/classic-editor'     => 'wp-content/mu-plugins/classic-editor/classic-editor.php',
				VSP_WP_LOCAL_TEMPLATE . 'wp-content/plugins/wordpress-importer' => 'wp-content/mu-plugins/wordpress-importer/wordpress-importer.php',
				'user-switching'                                                => 'wp-content/mu-plugins/user-switching/user-switching.php',
				'inspector'                                                     => 'wp-content/mu-plugins/inspector/inspector.php',
				'debug-quick-look'                                              => 'wp-content/mu-plugins/debug-quick-look/debug-quick-look.php',
			);
		}

		/**
		 * Updates SMTP Infomration With WordPress To Work With Local SMTP Server.
		 *
		 * @param $phpmailer
		 */
		public function setup_smtp_info( $phpmailer ) {
			if ( defined( 'LOCAL_SMTP_HOST' ) ) {
				$phpmailer->Host = LOCAL_SMTP_HOST;
			}
			if ( defined( 'LOCAL_SMTP_PORT' ) ) {
				$phpmailer->Port = LOCAL_SMTP_PORT;
			}
			if ( defined( 'LOCAL_SMTP_AUTH' ) ) {
				$phpmailer->SMTPAuth = LOCAL_SMTP_AUTH;
			}
			if ( defined( 'LOCAL_SMTP_UERNAME' ) ) {
				$phpmailer->Username = LOCAL_SMTP_UERNAME;
			}
			if ( defined( 'LOCAL_SMTP_PASSWORD' ) ) {
				$phpmailer->Password = LOCAL_SMTP_PASSWORD;
			}

			if ( defined( 'LOCAL_SMTP_HOST' ) && defined( 'LOCAL_SMTP_PORT' ) ) {
				$phpmailer->isSMTP();
			}
		}
	}
}