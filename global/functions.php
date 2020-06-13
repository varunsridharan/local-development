<?php
if ( ! function_exists( 'vsp_local_define' ) ) {
	/**
	 * Defines A Constant if not exists.
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @param mixed  $case_insensitive If set to true, the constant will be defined case-insensitive.
	 *
	 * @return bool
	 * @uses \define()
	 */
	function vsp_local_define( $key, $value, $case_insensitive = false ) {
		if ( ! defined( $key ) ) {
			define( $key, $value, $case_insensitive );
			return true;
		}
		return false;
	}
}

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

if ( ! function_exists( 'vsp_dev_copy' ) ) {
	/**
	 * @param $src
	 * @param $dst
	 */
	function vsp_dev_copy( $src, $dst ) {
		if ( is_dir( $src ) ) {
			$dir = opendir( $src . '/' );
			@mkdir( $dst );
			while ( false !== ( $file = readdir( $dir ) ) ) {
				if ( ! in_array( $file, array( '.', '..', '.git', 'node_module' ), true ) ) {
					if ( is_dir( $src . '/' . $file ) ) {
						vsp_dev_copy( $src . '/' . $file, $dst . '/' . $file );
					} else {
						copy( $src . '/' . $file, $dst . '/' . $file );
					}
				}
			}
			closedir( $dir );
		} else {
			copy( $src, $dst );
		}
	}
}

if ( ! function_exists( 'lorem_ispum' ) ) {
	/**
	 * @return bool|\joshtronic\LoremIpsum
	 * @example (
	 *    Generating Words
	 *        echo '1 word: '  . $lipsum->word();
	 *        echo '5 words: ' . $lipsum->words(5);
	 *    Generating Sentences
	 *        echo '1 sentence: '  . $lipsum->sentence();
	 *        echo '5 sentences: ' . $lipsum->sentences(5);
	 *    Generating Paragraphs
	 *        echo '1 paragraph: '  . $lipsum->paragraph();
	 *        echo '5 paragraphs: ' . $lipsum->paragraphs(5);
	 * )
	 */
	function lorem_ispum() {
		static $lipsum = false;
		if ( false === $lipsum ) {
			$lipsum = new joshtronic\LoremIpsum();
		}
		return $lipsum;
	}
}