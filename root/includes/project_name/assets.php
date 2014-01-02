<?php

class {%= projectNamespace %}Assets extends \ntzlib\assets\Assets{
  public function common(){}
  public function localize(){}

  public function admin(){
    wp_register_style( '{%= name %}-admin', $this->theme_path . "/assets/dist/stylesheets/admin.css", array(), $this->asset_version, 'screen' );

    wp_register_script( '{%= name %}-admin', $this->theme_path . "/assets/dist/javascripts/{%= name %}.admin.min.js", array(
      "jquery",
      "underscore",
      "jquery-ui-draggable",
      "jquery-ui-droppable"
    ), $this->asset_version, 'true' );

    wp_localize_script( '{%= name %}-admin', '{%= name %}_admin', array(
      'site_url' => esc_url( home_url( '/' ) ),
      'theme_directory' => $this->theme_path,
      'ajaxurl' => admin_url( 'admin-ajax.php' )
    ) );

    wp_enqueue_style( '{%= name %}-admin' );
    wp_enqueue_script( '{%= name %}-admin' );
  }


  public function frontend(){
    wp_register_style( '{%= name %}', $this->theme_path . "/assets/dist/stylesheets/screen.css", array(), $this->asset_version, 'screen' );
    wp_register_script( '{%= name %}-vendor', $this->theme_path . "/assets/dist/vendor/vendor.min.js", array(), $this->asset_version, 'true' );
    wp_register_script( '{%= name %}', $this->theme_path . "/assets/dist/javascripts/{%= name %}.min.js", array(
      "jquery",
      "{%= name %}-vendor",
      "underscore"
    ), $this->asset_version, 'true' );

    wp_enqueue_style( '{%= name %}' );
    wp_enqueue_script( '{%= name %}' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
      wp_enqueue_script( 'comment-reply' );
    }
  }
}