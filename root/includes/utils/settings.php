<?php
/**
 * Helper class to create options sections in WordPress
 * http://codex.wordpress.org/Settings_API#Graphical_Representation_of_where_all_those_code_should_go:
 *
 * Your basic sample need to:
 * 1. Set `option_page_name` & `options_id` variables
 * 2. Implement register_sections method
 * 3. Implement register_fields method (both of these methods contain examples and comments below)
 */

/*

class Foo extends NtzSettings {
  function __construct() {
    $this->option_page_name = "My Settings";
    $this->options_id       = "my-settings";
    parent::__construct();
  }

  public function register_sections(){
    add_settings_section( 'timers', 'Timers', '', $this->options_id ); // The section name and section title
  } // register_sections


  public function register_fields(){
    add_settings_field(
      'redirect_to_home_timer',                   // field name (also used below)
      'Redirect To Home Timer (in seconds)',      // label
      array( &$this, 'field_input' ),             // callback
      $this->options_id, 'timers',                // section (registered above)
      array(
        "field_id" => "redirect_to_home_timer", // field name (also used above)
        "type"       => "number",                 // input type="-"
        "default"    => 120
      )
    );
  } // register_fields
}

new Foo();

*/


abstract class NtzSettings extends NtzUtils {
  protected $option_page_name; // the menu entry
  protected $options_id; // lowercase, no spaces
  protected $storred_settings;

  function __construct() {
    $this->storred_settings = (array) get_option( $this->options_id );

    add_action( 'admin_menu', array( &$this, 'add_menu_pages' ) );
    add_action( 'admin_init', array( &$this, 'register_settings' ) );
  }


  public function add_menu_pages(){
    add_options_page( $this->option_page_name, $this->option_page_name, 'manage_options', $this->options_id, array( &$this, 'options_page' ) );
  } // add_menu_pages


  public function register_settings(){
    register_setting( $this->options_id . '-group', $this->options_id );

    $this->register_sections();
    $this->register_fields();
  } // register_settings


  abstract public function register_sections();
  abstract public function register_fields();


  public function add_field( $params = array() ){
    $params = array_merge( array(
      "field_id"       => null,
      "title"          => null,
      "type"           => "text",
      "label"          => "",
      "default"        => null,
      "section"        => null,
      "values"         => null,
      "value"          => 1,
      "class"          => "",
      "help"           => ""
    ), $params );

    $field_type = $this->get_field_type_callback( $params['type'] );

    add_settings_field(
      $params['field_id'],
      $params['title'],
      array( &$this, $field_type ),
      $this->options_id, $params['section'],
      $params
    );
  } // add_field


  public function text( $options ) {
    $stored_value = $this->get_stored_or_default_value( $options );

    $attributes = $this->convert_array_to_html_attributes(array(
      "name"  => $this->get_field_name( $options['field_id'] ),
      "type"  => $options['type'],
      "value" => esc_attr( $stored_value ),
      "class" => "regular-text " . $options['class']
    ));

    printf( '<input %s><p class="description">%s</p>',
      $attributes,
      $options['help']
    );
  }


  public function checkbox( $options ){
    $stored_value = $this->get_stored_or_default_value( $options );

    $attributes = $this->convert_array_to_html_attributes(array(
      "name"  => $this->get_field_name( $options['field_id'] ),
      "class" => " " . $options['class'],
      "value" => $options['value']
    ));

    printf( '<label><input type="checkbox" %s %s> %s</label>',
      checked( $options['value'], $stored_value, false ),
      $attributes,
      $options['label']
    );
  } // checkbox


  public function select( $options ){
    $stored_value = $this->get_stored_or_default_value( $options );
    $compiled_options = '';

    foreach ( $options['values'] as $available_option ) {

      if( !isset( $stored_value ) && isset( $available_option['selected'] ) && $available_option['selected'] ){
        $is_selected = selected( 1, 1, false );
      }else {
        $current_value = isset( $available_option['value'] ) ? $available_option['value'] : '' ;
        $is_selected = selected( $current_value, $stored_value, false );
      }

      $compiled_options .= sprintf( '<option value="%1$s" %3$s>%2$s</option>',
        isset( $available_option['value'] ) ? $available_option['value']  : '',
        isset( $available_option['text'] ) ? $available_option['text']  : '',
        $is_selected
      );
    }

    printf( '<select name="%s">%s</select><p class="description">%s</p>',
      $this->get_field_name( $options['field_id'] ),
      $compiled_options,
      $options['help']
    );
  } // select





  protected function get_field_type_callback( $field_type ){
    switch ( $field_type ) {
      case 'checkbox':
        $callback = 'checkbox';
      break;

      case 'select':
        $callback = 'select';
      break;

      default:
        $callback = 'text';
      break;
    }

    return $callback;
  } // get_field_type_callback


  protected function get_field_name( $name ){
    return sprintf( '%1$s[%2$s]',
      $this->options_id,
      $name
    );
  } // get_field_name

  protected function get_stored_or_default_value( $options ){
    if (
      isset( $this->storred_settings[ $options['field_id'] ] ) &&
      !empty( $this->storred_settings[ $options['field_id'] ] )
    ){
      return $this->storred_settings[ $options['field_id'] ];
    }else {
      return $options['default'];
    }
  } // get_stored_or_default_value



  public function options_page(){
  ?>

    <div class="wrap">
      <h2><?php echo $this->option_page_name; ?></h2>
      <form action="options.php" method="POST">
      <?php settings_fields( $this->options_id . '-group' ); ?>
      <?php do_settings_sections( $this->options_id ); ?>
      <?php submit_button(); ?>
      </form>
    </div>

  <?php
  } // options_page
}
