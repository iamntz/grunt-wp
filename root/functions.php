<?php

define( 'ASSETS_VERSION', WP_DEBUG ? time() : 1 );
define( 'THEME_PATH', get_stylesheet_directory_uri() );

require_once( 'includes/ntzlib/ntzlib.php' );

require_once( 'includes/{%= name %}/assets.php' );
require_once( 'includes/{%= name %}/theme_init.php' );

new {%= projectNamespace %}Assets();
new {%= projectNamespace %}ThemeInit();