<?php

class {%= projectNamespace %}ThemeInit {
  function __construct() {
    add_action( 'after_setup_theme', array( &$this, 'theme_setup' ) );
    add_action( 'widgets_init', array( &$this, 'widgets' ) );
  }


  public function theme_setup(){
    add_theme_support( 'post-thumbnails', array( 'post' ) );

    register_nav_menus( array(
      'primary'   => __( 'Top primary menu', '{%= name %}' ),
    ) );

    add_theme_support( 'post-formats', array(
      'aside', 'image', 'video', 'quote', 'link', 'gallery',
    ) );
  } // theme_setup


  public function widgets(){
    register_sidebar( array(
      'name'          => __( 'Primary Sidebar', '{%= name %}' ),
      'id'            => 'sidebar-1',
      'description'   => __( 'Main sidebar that appears on the left.', '{%= name %}' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h1 class="widget-title">',
      'after_title'   => '</h1>',
    ) );
  } // widgets
}