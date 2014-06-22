<?php
$path = '../../../../wordpress-tests/includes/bootstrap.php';

if( file_exists( $path ) ) {
  require_once $path;
} else {
  exit( "Couldn't find path to wordpress-tests/bootstrap.php\n" );
}