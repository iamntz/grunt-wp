<?php namespace ntzlib;

abstract class CustomPostTypes {
  function __construct() {
    add_action( 'init', array( &$this, 'init' ) );
  }


  abstract public function init();


  protected function settings( $options = array() ){
    return array_merge( array(
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'capability_type'    => 'page',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array( 'title', 'thumbnail', 'editor' )
    ), $options );
  } // settings


  protected function labels( $singular, $plural = false ){
    $plural = !$plural ? $singular . 's' : $plural;

    return array(
      'name'               => "{$plural}",
      'singular_name'      => "{$singular}",
      'add_new'            => "Add New",
      'add_new_item'       => "Add New {$singular}",
      'edit_item'          => "Edit {$singular}",
      'new_item'           => "New {$singular}",
      'all_items'          => "All {$plural}",
      'view_item'          => "View {$singular}",
      'search_items'       => "Search {$plural}",
      'not_found'          => "No {$plural} found",
      'not_found_in_trash' => "No {$plural} found in Trash",
      'parent_item_colon'  => '',
      'menu_name'          => "{$plural}"
    );
  } // labels


  protected function tax_labels( $singular, $plural = false){
    $plural = !$plural ? $singular . 's' : $plural;
    $plural_capitalized = strtolower( $plural );

    return array(
      'name'                       => $plural,
      'singular_name'              => $singular,
      'search_items'               => __( "Search {$plural}" ),
      'popular_items'              => __( "Popular {$plural}" ),
      'all_items'                  => __( "All {$plural}" ),
      'parent_item'                => __( "Parent {$singular}" ),
      'parent_item_colon'          => __( "Parent {$singular}:" ),
      'edit_item'                  => __( "Edit {$singular}" ),
      'update_item'                => __( "Update {$singular}" ),
      'add_new_item'               => __( "Add New {$singular}" ),
      'new_item_name'              => __( "New {$singular} Name" ),
      'separate_items_with_commas' => __( "Separate {$plural_capitalized} with commas" ),
      'add_or_remove_items'        => __( "Add or remove {$plural_capitalized}" ),
      'choose_from_most_used'      => __( "Choose from the most used {$plural_capitalized}" ),
      'not_found'                  => __( "No {$plural_capitalized} found." ),
      'menu_name'                  => __( "{$plural}" ),
    );
  } // tax_labels


  protected function tax_settings( $options = array() ){
    return array_merge( array(
      'hierarchical'      => true,
      'labels'            => $options['labels'],
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => null ),
    ), $options );
  } // tax_settings
}