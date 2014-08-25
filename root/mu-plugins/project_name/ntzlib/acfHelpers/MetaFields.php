<?php

namespace ntzlib\acfHelpers;

class MetaFields extends \acf_field {
  function __construct() {
    $this->name     = 'meta_fields';
    $this->label    = 'Meta Fields';
    $this->category = 'Custom';

    $this->defaults = array(
      'title'       => '',
      'subtitle'    => '',
      'description' => '',
    );


    $this->l10n = array(
      'error' => __('Error! Please enter a value', 'acf-box_icon'),
    );
    parent::__construct();
  }


  function render_field( $field ) {
    $metaFields = explode( "\n", $field['custom_fields'] );
    $displayFieldsInline = isset( $field['display_fields_inline'] ) && $field['display_fields_inline'] == 1;

    if( $displayFieldsInline ){ echo '<div class="ntz-table"><div>'; }
    foreach ( $metaFields as $metaField ) {
      if( empty( $metaField ) ){
        echo "Are you sure you added fields?";
        return;
      }

      $metaField    = explode( ':', $metaField );
      $label        = trim( $metaField[0] );
      $fieldName    = trim( $metaField[1] );
      $fieldType    = isset( $metaField[2] ) ? trim( $metaField[2] ) : 'text';
      $fieldType    = explode( "|", $fieldType );
      $defaultValue = !empty( $fieldType[1] ) ? $fieldType[1] : '';
      $fieldType    = $fieldType[0];
      $value        = isset( $field['value'][$fieldName] ) ? $field['value'][$fieldName] : $defaultValue;
      $fieldName    = $field['name'] . "[{$fieldName}]";

      echo '<div>';
      printf( '<label for="%s">%s:</label>', $fieldName, $label );
      if( $fieldType == 'textarea' ){
        printf( '<textarea name="%1$s" id="%1$s">%2$s</textarea>',
          $fieldName,
          esc_attr( $value )
        );
      }else if ( preg_match( "/color(picker)?/", $fieldType ) ){
        printf( '<input type="text" class="ntz-colorpicker" name="%1$s" id="%1$s" value="%2$s" />',
          $fieldName,
          esc_attr( $value )
        );
        echo '<script type="text/javascript"> jQuery(document).ready(function($){ $(".ntz-colorpicker").wpColorPicker(); }); </script>';
      }else {
        printf( '<input type="text" name="%1$s" id="%1$s" value="%2$s">',
          $fieldName,
          esc_attr( $value )
        );
      }
      echo '</div>';
    }
    if( $displayFieldsInline ){ echo '</div></div>'; }

    ?>

    <style type="text/css" media="screen">
      .ntz-table label { display:block; }
      .ntz-table > div > div { display:inline-block; vertical-align:top; padding-left:2em; }
      .ntz-table > div > div:first-child { padding-left:0; }
    </style>

    <?php
  }


  public function input_admin_enqueue_scripts(){
    wp_enqueue_style( 'wp-color-picker' );
  }


  function render_field_settings( $field ) {
    acf_render_field_setting( $field, array(
      'label'        => __('Extra Fields To Show','acf'),
      'instructions' => 'Use a format like <code>label:field_name:textarea</code> (multiple fields on multiple lines)',
      'type'         => 'textarea',
      'name'         => 'custom_fields',
      'value'        => apply_filters( 'ntz/acf/default-metafields', '' )
    ));

    acf_render_field_setting( $field, array(
      'label'        => __('Display all fields on one line?','acf'),
      'instructions' => '',
      'type'      => 'radio',
      'choices'   => array(
        1       => __("Yes",'acf'),
        0       => __("No",'acf'),
      ),
      'layout'  =>  'horizontal',
      'name'         => 'display_fields_inline',
      'value'        => 1
    ));
  }

}

new MetaFields();