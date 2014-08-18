<?php namespace ntzlib\assets;

abstract class Assets {
  protected $asset_version, $theme_path;

  function __construct( $assetVersion = 1 ) {
    $this->asset_version = WP_DEBUG ? time() : $assetVersion;
    $this->theme_path    = get_stylesheet_directory_uri();
    $this->min_or_dev    = WP_DEBUG ? '' : 'min';

    add_action( 'admin_enqueue_scripts', array( &$this, 'common' ) );
    add_action( 'wp_enqueue_scripts',    array( &$this, 'common' ) );

    add_action( 'admin_enqueue_scripts', array( &$this, 'admin' ) );
    add_action( 'wp_enqueue_scripts',    array( &$this, 'frontend' ) );

    add_action( 'admin_enqueue_scripts', array( &$this, 'localize' ) );
    add_action( 'wp_enqueue_scripts',    array( &$this, 'localize' ) );
  }


  abstract public function common();
  abstract public function admin();
  abstract public function frontend();
  abstract public function localize();
}