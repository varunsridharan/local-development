<?php

$time_took = vsp_timer( 'vsp-local-process-start', true, 10 );
/**
 * <script>
 * var vsp_local_time_took = $time_took;
 * </script>
 */
if ( ! in_array( 'content-type: application/json', headers_list() ) ) {
	echo <<<HTML
<!-- Total Time Took For PHP Process : $time_took -->
HTML;
}
