<?php

add_theme_support( 'post-thumbnails' );
// add_image_size( 'image-size-name', 500, 300, true );

define( 'ASSETS_VERSION', WP_DEBUG ? time() : 1 );
define( 'THEME_PATH', get_stylesheet_directory_uri() );

require_once( 'includes/ntzlib/ntzlib.php' );

require_once( 'includes/{%= name %}/assets.php' );
require_once( 'includes/{%= name %}/theme_init.php' );

new {%= projectNamespace %}Assets();
new {%= projectNamespace %}ThemeInit();