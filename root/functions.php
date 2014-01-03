<?php

define( 'ICL_DONT_LOAD_NAVIGATION_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGES_JS', true );
define( 'ICL_DONT_PROMOTE', true );

define( 'ASSETS_VERSION', WP_DEBUG ? time() : 1 );
define( 'THEME_PATH', get_stylesheet_directory_uri() );

if( !defined( 'ACF_LITE' ) ){
  define( 'ACF_LITE', !WP_DEBUG && defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV );
}
/*
if( !class_exists('acf') ){
  require_once( 'plugins/acf/acf.php' );
}
*/
/*
if( !class_exists( 'acf_options_page_plugin' ) ){
  require_once( 'plugins/acf-options-page/acf-options-page.php' );
}
*/
/*
if( !class_exists( 'acf_field_repeater' ) ){
  require_once( 'plugins/acf-repeater/acfrepeater-.php' );
}
*/
require_once( 'includes/vendor/mustache/src/Mustache/Autoloader.php' );

require_once( 'includes/ntzlib/ntzlib.php' );

require_once( 'includes/{%= name %}/assets.php' );
require_once( 'includes/{%= name %}/theme_init.php' );

new {%= projectNamespace %}Assets();
new {%= projectNamespace %}ThemeInit();