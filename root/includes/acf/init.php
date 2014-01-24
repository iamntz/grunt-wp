<?php

if( !defined( 'ACF_LITE' ) ){
  define( 'ACF_LITE', !WP_DEBUG && defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV );
}

if( !class_exists('acf') ){
  require_once( 'plugins/acf/acf.php' );
}


if( !class_exists( 'acf_options_page_plugin' ) ){
  require_once( 'plugins/acf-options-page/acf-options-page.php' );
}


if( !class_exists( 'acf_field_repeater' ) ){
  require_once( 'plugins/acf-repeater/acfrepeater-.php' );
}


if( function_exists( 'icl_object_id' ) ){
  function {%= projectNamespace.toLowerCase() %}_set_options_const(){
    $option_names = array(
      "identity",
      "social_network"
    );

    foreach ( (array) $option_names as $option_name ) {
      $option_name_const = strtoupper( $option_name );
      if( !defined( 'OPTIONS_' . $option_name_const ) ) {
        $field = get_field( $option_name, 'option' );
        $value = !isset( $field ) || empty( $field ) ? null : icl_object_id( $field->ID, '{%= projectNamespace.toLowerCase() %}_options', true, ICL_LANGUAGE_CODE );
        define( 'OPTIONS_' . $option_name_const, $value );
      }
    }
  }

  add_action( 'init', '{%= projectNamespace.toLowerCase() %}_set_options_const' );
}


if( ACF_LITE ){
  require_once( 'acf_fields.php' );
}