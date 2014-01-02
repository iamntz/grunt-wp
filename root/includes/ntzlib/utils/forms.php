<?php namespace ntzlib\utils;

/**
 * A collection of static utilites to create form elements inspired by Laravel framework
 */
class Forms extends Utils {

  /**
   * Generic input helper.
   * @param  string  $name the name of the input
   * @param  array   $atts attributes for input element
   * @return string
   */
  public static function input( $name = "", $atts = array() ){
    $atts = array_merge( array(
      "type" => "text"
    ), $atts );
    return sprintf(
      '<input name="%s"%s>',
      $name,
      parent::convert_array_to_html_attributes( $atts )
    );
  } // input


  /**
   * Select helper
   * @param  string $name     the name of the select
   * @param  array  $options  dropdown options
   * @param  mixed  $selected the value of the selected option
   * @param  array  $atts     extra attributes for the select
   * @return string
   */
  public static function select( $name = "", $options = array(), $selected = null, $atts = array() ){
    $compiled_options = '';

    if( is_array( $options ) && count( $options ) ){
      foreach ( $options as $value => $text ) {
        $compiled_options .= self::option( $text, $value, $selected );
      }
    }

    //  TODO: add optgroups
    $select = sprintf(
      '<select name="%s"%s>%s</select>',
      $name,
      parent::convert_array_to_html_attributes( $atts ),
      $compiled_options
    );

    return $select;
  } // select


  /**
   * Create an option tag
   * @param  string $text     the text inside of the option tag
   * @param  string $value    the value of the element
   * @param  string $selected the value of the selected option
   * @param  string $disabled disables the option
   * @return string
   */
  protected static function option( $text, $value = null, $selected = null, $disabled = null ){
    return sprintf(
      '<option value="%s"%s%s>%s</option>',
      $value,
      selected( $selected, $value, false ),
      $disabled ? ' disabled' : '',
      $text
    );
  } // option
}