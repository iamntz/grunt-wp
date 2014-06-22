<?php

require_once( 'ntz.php' );
class NtzFormsTest extends WP_UnitTestCase {
  function __construct() {

  }


  public function testInput(){
    $this->assertTrue( method_exists( 'NtzForms', 'input' ), "Input method exists" );
    $this->assertEquals( '<input name="foo" type="text">', NtzForms::input( "foo" ), 'Input attributes are added' );
    $this->assertEquals( '<input name="" type="search">', NtzForms::input( "", array( "type" => "search" ) ), 'Attributes are added' );
  } // testInput


  public function testSelect(){
    $this->assertTrue( method_exists( 'NtzForms', 'select'), "Select method exists" );
    $this->assertEquals( '<select name="foo"></select>', NtzForms::select("foo") , 'Select form is generated' );

    $sampleOptions = array(
      "foo" => "bar"
    );
    $this->assertEquals(
      '<select name=""><option value="foo">bar</option></select>',
      NtzForms::select( "", $sampleOptions ),
      'Select form is populated'
    );

    $this->assertEquals(
      '<select name=""><option value="foo" selected=\'selected\'>bar</option></select>',
      NtzForms::select( "", $sampleOptions, "foo" ),
      'Option is selected'
    );
  }

}