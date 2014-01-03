<?php

Mustache_Autoloader::register();

function tpl_helper( $template, $content = array() ){
  $theme_path = get_template_directory();
  $mustache = new Mustache_Engine(array(
    'template_class_prefix' => '__cache',
    'cache' => $theme_path . '/views/cache',
    'cache_file_mode' => 0666, // Please, configure your umask instead of doing this :)
    'cache_lambda_templates' => true,
    'loader' => new Mustache_Loader_FilesystemLoader( $theme_path . '/views' ),
    'partials_loader' => new Mustache_Loader_FilesystemLoader( $theme_path . '/views/partials' ),
    'escape' => function($value) {
        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
    },
    'charset' => 'UTF-8',
    'logger' => new Mustache_Logger_StreamLogger('php://stderr'),
    'strict_callables' => true,
  ));

  $tpl = $mustache->loadTemplate( $template );
  return $tpl->render( $content );
} // tpl_helper