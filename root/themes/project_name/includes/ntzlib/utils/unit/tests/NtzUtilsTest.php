<?php

require_once( 'ntz.php' );
class NtzUtilsTest extends WP_UnitTestCase {
  function __construct() {

  }

  public function testConvertArrayToHtmlAttributes(){
    $this->assertTrue( method_exists( 'NtzUtils', 'convert_array_to_html_attributes' ) );

    $this->assertTrue( method_exists( 'NtzUtils', 'convert_array_to_html_attribute' ) );
    $this->assertEquals( '', NtzUtils::convert_array_to_html_attribute( array() ), "Empty array should return empty string" );
    $this->assertEquals( ' foo="bar"', NtzUtils::convert_array_to_html_attribute( array( "foo" => "bar" ) ) , 'Simple attribute is converted correctly' );

    $sample_attributes = array(
      "foo" => "bar",
      "baz" => "foo"
    );

    $this->assertEquals(
      ' foo="bar" baz="foo"',
      NtzUtils::convert_array_to_html_attributes( $sample_attributes ),
      'Multidimensional attributes are converted correctly'
    );
  } // testConvertArrayToHtmlAttributes
}