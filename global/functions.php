<?php
if ( ! function_exists( 'printr' ) ) {
	/**
	 * Functions uses print_r along with html pre tag.
	 *
	 * @param      $data
	 * @param bool $echo
	 *
	 * @return string
	 * @uses print_r
	 */
	function printr( $data, $echo = false ) {
		$d = '<pre>' . print_r( $data, true ) . '</pre>';

		if ( $echo ) {
			echo $d;
		}
		return $d;
	}
}

if ( ! function_exists( 'console' ) ) {
	/**
	 * Logs To A file using error_log
	 *
	 * @param mixed ...$arg
	 *
	 * @return bool
	 * @uses print_r
	 */
	function console( ...$arg ) {
		return error_log( print_r( $arg, true ) );
	}
}

if ( ! function_exists( 'vsp_timer' ) ) {
	/**
	 * @param string $key Unique Timer Key.
	 * @param bool   $stop true / false
	 * @param int    $precision
	 *
	 * @return bool|string
	 */
	function vsp_timer( $key = '', $stop = false, $precision = 3 ) {
		if ( ! class_exists( 'VSP_Local_Benchmark', false ) ) {
			require_once VSP_LOCAL_DIR . '/global/benchmark.php';
		}
		return ( ! $stop ) ? VSP_Local_Benchmark::timer_start( $key ) : VSP_Local_Benchmark::timer_stop( $key, $precision );
	}
}

if ( ! function_exists( 'is_debug_view' ) ) {
	/**
	 * Checks if its log view request.
	 */
	function is_debug_view() {
		$types = array( 'debug-log', 'debuglog', 'logs', 'wpdebug', 'wplog' );
		foreach ( $types as $key ) {
			if ( isset( $_REQUEST[ $key ] ) ) {
				$file = false;
				if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/wp-content/debug.log' ) ) {
					$file = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/debug.log';
				}

				if ( $file ) {
					global $log_view_config;
					$log_view_config = array( 'file_path' => $file );
					require_once VSP_LOCAL_DIR . '/global/logivew.php';
					exit;
				}
			}
		}
	}
}

if ( ! function_exists( 'vspdev_link_muplugins' ) ) {
	/**
	 * @param bool $path
	 *
	 * @since {NEWVERSION}
	 */
	function vspdev_link_muplugins( $path = false ) {
		if ( ! $path && defined( 'ABSPATH' ) ) {
			$path = ABSPATH;
		}

		if ( $path ) {
			//if ( file_exists( $path . 'wp-content/mu-plugins/vsp-development.php' ) ) {
			//	unlink( $path . 'wp-content/mu-plugins/vsp-development.php' );
			//}
			if ( ! file_exists( $path . 'wp-content/mu-plugins/vsp-dev.php' ) ) {
				@mkdir( $path . 'wp-content/mu-plugins/' );
				symlink( 'E:\localhost\www\wp\template\wp-content\mu-plugins\vsp-dev.php', $path . 'wp-content/mu-plugins/vsp-dev.php' );
			}
		}
	}
}

if ( ! function_exists( 'vspdev_link_file' ) ) {
	/**
	 * @param bool $path
	 *
	 * @since {NEWVERSION}
	 */
	function vspdev_link_file( $path = false ) {
		vspdev_link_muplugins( $path );
	}
}
