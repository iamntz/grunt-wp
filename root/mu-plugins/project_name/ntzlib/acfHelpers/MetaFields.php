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
    foreach ( $metaFields as $metaField ) {
      $val       = '';
      $metaField = explode( ':', $metaField );
      $label     = trim( $metaField[0] );
      $fieldName = trim( $metaField[1] );
      $value     = isset( $field['value'][$fieldName] ) ? $field['value'][$fieldName] : '';
      $fieldType = isset( $metaField[2] ) ? trim( $metaField[2] ) : 'text';
      $fieldName = $field['name'] . "[{$fieldName}]";



      echo '<div>';
      printf( '<label for="">%s:</label>', $label );
      if( $fieldType == 'textarea' ){
        printf( '<textarea name="%s">%s</textarea>',
          $fieldName,
          esc_attr( $value )
        );
      }else {
        printf( '<input type="text" name="%s" value="%s">',
          $fieldName,
          esc_attr( $value )
        );
      }
      echo '</div>';
    }
  }




  function render_field_settings( $field ) {
    acf_render_field_setting( $field, array(
      'label'        => __('Extra Fields To Show','acf'),
      'instructions' => 'Use a format like <code>label:field_name:textarea</code> (multiple fields on multiple lines)',
      'type'         => 'textarea',
      'name'         => 'custom_fields',
      'value'        => apply_filters( 'ntz/acf/default-metafields', '' )
    ));
  }

}

new MetaFields();