<?php namespace ntzlib\utils;


class Utils {

  /**
   * Converts an array of key=>value pairs to a string of html attributes
   * @param  array  $attributes A multidimensional array
   * @return string             html attributes
   */
  public static function convert_array_to_html_attributes( Array $attributes ){
    $parsed_attributes = '';

    $attributes = array_chunk( $attributes, 1, true );
    foreach ( $attributes as $value ) {
      $parsed_attributes .= self::convert_array_to_html_attribute( $value );
    }

    return $parsed_attributes;
  } // convert_array_to_html_attributes


  /**
   * Converts an array with a single pair of key=>value to an attribute.
   * If the array element is not key=>value, then the returned string is just the value (useful for HTML5 attributes: checked, readonly, etc)
   * If multiple array is passed, only first item is converted
   * @param  array  $attributes An array with key=>value
   * @return string            html attribute
   */
  public static function convert_array_to_html_attribute( Array $attributes ){
    $attribute = '';

    if( !empty( $attributes ) ){
      $key = key( $attributes );
      if( !$key ){
        $attribute = $attributes[$key];
      }else {
        $attribute = sprintf( ' %s="%s"', $key, $attributes[$key] );
      }
    }

    return $attribute;
  } // convert_array_to_html_attribute
}
