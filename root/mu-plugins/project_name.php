<?php

// require_once( '{%= name %}/ntzlib/custom_post_types.php' );
// require_once( '{%= name %}/custom_post_types.php' );
// require_once( '{%= name %}/shortcodes.php' );


if( !defined( 'ACF_LITE' ) ){
  define( 'ACF_LITE', !WP_DEBUG && defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV );
}

if( ACF_LITE ){
  require_once( '{%= name %}/acf_export.php' );
}