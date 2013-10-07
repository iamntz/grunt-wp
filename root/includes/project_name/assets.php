<?php

class {%= projectNamespace %}Assets {
  function __construct() {
    add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_assets' ) );
    add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_assets' ) );
  }


  public function enqueue_common_assets(){} // enqueue_common_assets


  public function enqueue_admin_assets(){
    $this->enqueue_common_assets();
    wp_register_style( '{%= name %}-admin', THEME_PATH . "/assets/dist/stylesheets/admin.css", array(), ASSETS_VERSION, 'screen' );
    wp_register_script( '{%= name %}-admin', THEME_PATH . "/assets/dist/javascripts/{%= name %}.admin.min.js", array(
      "jquery"
      ,"underscore"
      ,"jquery-ui-draggable"
      ,"jquery-ui-droppable"
    ), ASSETS_VERSION, 'true' );

    wp_localize_script( '{%= name %}-admin', '{%= name %}_admin', array(
      'site_url' => esc_url( home_url( '/' ) ),
      'theme_directory' => THEME_PATH,
      'ajaxurl' => admin_url( 'admin-ajax.php' )
    ) );

    wp_enqueue_style( '{%= name %}-admin' );
    wp_enqueue_script( '{%= name %}-admin' );
  } // enqueue_admin_assets


  public function enqueue_assets(){
    $this->enqueue_common_assets();
    wp_register_style( '{%= name %}', THEME_PATH . "/assets/dist/stylesheets/screen.css", array( '{%= name %}-fonts' ), ASSETS_VERSION, 'screen' );
    wp_register_script( '{%= name %}-vendor', THEME_PATH . "/assets/dist/vendor/vendor.min.js", array(), ASSETS_VERSION, 'true' );
    wp_register_script( '{%= name %}', THEME_PATH . "/assets/dist/javascripts/{%= name %}.min.js", array(
      "jquery"
      ,"{%= name %}-vendor"
      ,"underscore"
    ), ASSETS_VERSION, 'true' );

    wp_enqueue_style( '{%= name %}' );
    wp_enqueue_script( '{%= name %}' );

    $stored_settings = (array) get_option( '{%= name %}-settings' );
    $stored_settings = array_merge( array(
      "foo" => "bar"
    ), $stored_settings );

    wp_localize_script( '{%= name %}', '{%= name %}', array(
      'site_url' => esc_url( home_url( '/' ) ),
      'ajaxurl'  => admin_url( 'admin-ajax.php' ),
      'foo'      => $stored_settings['foo']
    ) );
  } // enqueue_assets
}