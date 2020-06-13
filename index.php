<?php
require_once __DIR__ . 'global/functions.php';

vsp_local_define( 'VSP_LOCAL_DIR', __DIR__ . '/' );

vsp_local_define( 'VSP_WP_LOCAL_TEMPLATE', 'E:\localhost\www\wp\template\\' );

vsp_local_define( 'LOCAL_SMTP_HOST', '127.0.0.1' );

vsp_local_define( 'LOCAL_SMTP_PORT', '2525' );

vsp_local_define( 'LOCAL_SMTP_AUTH', false );


// Checks if its a log view
is_debug_view();
