<?php
if ( ! class_exists( 'VSP_Local_Benchmark', false ) ) {
	class VSP_Local_Benchmark {
		/**
		 * Stores Timer Information.
		 *
		 * @var array
		 */
		protected static $timer = array();

		/**
		 * Start the WordPress micro-timer.
		 *
		 * @param string $key Unique Timer Key.
		 *
		 * @return mixed
		 */
		public static function timer_start( $key ) {
			self::$timer[ $key ] = microtime( true );
			return self::$timer[ $key ];
		}

		/**
		 * Retrieve or display the time from the page start to when function is called.
		 *
		 * @param string $key Unqiue Timer Key.
		 * @param int    $precision
		 *
		 * @return bool|string
		 */
		public static function timer_stop( $key = '', $precision = 3 ) {
			if ( isset( self::$timer[ $key ] ) ) {
				$timetotal = microtime( true ) - self::$timer[ $key ];
				return ( function_exists( 'number_format_i18n' ) ) ? number_format_i18n( $timetotal, $precision ) : number_format( $timetotal, $precision );
			}
			return false;
		}
	}
}