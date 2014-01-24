<?php

define( 'ICL_DONT_LOAD_NAVIGATION_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGES_JS', true );
define( 'ICL_DONT_PROMOTE', true );

require( 'includes/acf/init.php' );

define( 'ASSETS_VERSION', WP_DEBUG ? time() : 1 );
define( 'THEME_PATH', get_stylesheet_directory_uri() );


require_once( 'includes/vendor/mustache/src/Mustache/Autoloader.php' );

require_once( 'includes/ntzlib/ntzlib.php' );

require_once( 'includes/{%= name %}/assets.php' );
require_once( 'includes/{%= name %}/theme_init.php' );

new {%= projectNamespace %}Assets();
new {%= projectNamespace %}ThemeInit();