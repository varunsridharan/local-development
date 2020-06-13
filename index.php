<?php
require_once __DIR__ . 'global/functions.php';

vsp_local_define( 'KB_IN_BYTES', ( 1024 ) );

vsp_local_define( 'MB_IN_BYTES', ( 1024 * KB_IN_BYTES ) );

vsp_local_define( 'GB_IN_BYTES', ( 1024 * MB_IN_BYTES ) );

vsp_local_define( 'TB_IN_BYTES', ( 1024 * GB_IN_BYTES ) );

vsp_local_define( 'VSP_LOCAL_DIR', __DIR__ . '/' );

vsp_local_define( 'VSP_WP_LOCAL_TEMPLATE', 'E:\localhost\www\wp\template\\' );

vsp_local_define( 'LOCAL_SMTP_HOST', '127.0.0.1' );

vsp_local_define( 'LOCAL_SMTP_PORT', '2525' );

vsp_local_define( 'LOCAL_SMTP_AUTH', false );

/**
 * 1000 Bytes = 1 KB
 * 200 * 10000 = 200KB
 */
vsp_local_define( 'WP_DEBUG_LOG_MAX_SIZE', ( KB_IN_BYTES * 200 ) );
vsp_local_define( 'WP_DEBUG_LOG_OVERFLOW_STORAGE', 'debuglogs' );


// Checks if its a log view
is_debug_view();
