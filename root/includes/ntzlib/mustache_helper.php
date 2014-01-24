<?php

Mustache_Autoloader::register();

function tpl_helper( $template, $content = array() ){
  $theme_path = apply_filters( 'ntz/mustache/theme_path', get_template_directory() );

  $mustache   = new Mustache_Engine(array(
    'template_class_prefix' => '__cache',
    'cache'                 => $theme_path . '/views/cache',
    'loader'                => new Mustache_Loader_FilesystemLoader( $theme_path . '/views' ),
    'partials_loader'       => new Mustache_Loader_FilesystemLoader( $theme_path . '/views/partials' ),
    'logger'                => new Mustache_Logger_StreamLogger('php://stderr'),
    'escape'                => function($value) {
        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
    },
  ));

  $tpl = $mustache->loadTemplate( $template );

  return $tpl->render( array_merge(
    array(
      "i8n" => apply_filters( 'ntz/mustache/i8n_strings', array() )
    ),
    $content
  ) );
} // tpl_helper
