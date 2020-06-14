<?php

$time_took = vsp_timer( 'vsp-local-process-start', true, 10 );
echo <<<HTML
<!-- Total Time Took For PHP Process : $time_took -->
<script>
var vsp_local_time_took = $time_took;
</script>
HTML;
