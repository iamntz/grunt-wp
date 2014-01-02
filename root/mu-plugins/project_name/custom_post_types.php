<?php namespace {%= projectNamespace %};

class CustomPostTypes extends \ntzlib\CustomPostTypes{
  function init() {
    $this->sample_post_type();
  }


  public function sample_post_type(){
    $tax_name = 'sample_taxonomy';
    $tax_args = $this->tax_settings(array(
      'labels'  => $this->tax_labels('Sample Taxonomy Label'),
      'rewrite' => array( 'slug' => 'custom_slug' ),
    ));
    register_taxonomy( "{%= name %}_{$tax_name}", array( "{%= name %}_{$tax_name}" ), $tax_args );

    $cpt_args = $this->settings(array(
      'labels'     => $this->labels( 'Sample' ),
      'rewrite'    => array( 'slug' => 'custom_slug' ),
      'taxonomies' => array( "{%= name %}_{$tax_name}" ),
    ));
    register_post_type( '{%= name %}_sample', $cpt_args );
  } // sample_post_type
}

new \{%= projectNamespace %}\CustomPostTypes();