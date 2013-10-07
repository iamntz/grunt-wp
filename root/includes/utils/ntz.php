<?php


class NtzUtils {
  function __construct() {
    # code...
  }

  public static function convert_array_to_html_attributes( $attributes = array() ){
    $parsed_attributes = '';

    $attributes = array_chunk( $attributes, 1, true );
    foreach ( $attributes as $value ) {
      $parsed_attributes .= self::convert_array_to_html_attribute( $value );
    }

    return $parsed_attributes;
  } // convert_array_to_html_attributes

  public static function convert_array_to_html_attribute( $attributes = array() ){
    $attribute = '';

    if( !empty( $attributes ) ){
      $key = key( $attributes );
      $attribute .= sprintf( ' %s="%s"', $key, $attributes[$key] );
    }

    return $attribute;
  } // convert_array_to_html_attribute
}

require_once( 'next_page.php' );
require_once( 'settings.php' );
require_once( 'forms.php' );