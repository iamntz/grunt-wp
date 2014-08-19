<?php

namespace ntzlib\acfHelpers;

class IconSelector extends \acf_field {
  function __construct() {
    $this->name     = 'icon_selector';
    $this->label    = 'Icon Selector';
    $this->category = 'Custom';

    $this->base_bath = apply_filters( 'ntz/acf/base_path', get_template_directory() );
    $this->find_css_class_regex = apply_filters( 'ntz/acf/find_css_class_regex', '/(icon-[^\s]+):before/' );

    $this->defaults = array(
      'icons_path' => ''
    );


    $this->l10n = array(
      'error' => __('Error! Please enter a value', 'acf-box_icon'),
    );
    parent::__construct();
  }


  function render_field( $field ) {
    $this->show_styles();
    $this->show_javascript();
    $this->show_icon_selector( $field );
    ?>
    <span class="ntz-acf-iconSelector-preview"></span>
    <?php
  }


  protected function show_icon_selector( $field ){
    $fontFile =  $this->base_bath . '/' .  $field['icons_path'] ;

    if( file_exists( $fontFile ) ) {
      $icons = file_get_contents( $fontFile );
      preg_match_all( $this->find_css_class_regex, $icons, $available_icons );
    } else {
      echo "No icons available. Are you sure it's the right path?";
      return;
    }
    ?>

    <select class="ntz-acf-iconSelector ntz-acf-iconSelectorShowPreview" name="<?php echo $field['name'] ?>[icon]">
      <option value="0">No Icon</option>
    <?php
    $icon_value = isset( $field['value']['icon'] ) ? $field['value']['icon'] : '';

    foreach ( $available_icons[1] as $keyIcon => $icon ) {
      $displayName = str_ireplace( 'icon-', '', $available_icons[1][$keyIcon] );

      printf( '<option value="%s" %s data-preview="%s">%s</option>',
        $icon,
        selected( $icon_value, $icon, false ),
        $available_icons[1][$keyIcon],
        ucfirst( $displayName )
      );
    }
    echo '</select>';
  }


  function render_field_settings( $field ) {

    // post_type
    acf_render_field_setting( $field, array(
      'label'        => __('Icons Path','acf'),
      'instructions' => '',
      'type'         => 'text',
      'name'         => 'icons_path',
      'value'        => $this->defaults['icons_path']
    ));
  }


  protected function show_styles(){
    ?>

    <style type="text/css" media="screen">
    select.ntz-acf-iconSelector {
      display:inline-block;
      margin-right:2%;
      max-width:80%;
    }

    .ntz-acf-iconSelector-preview {
      display:inline-block;
      font-size:30px;
      vertical-align:middle;
    }
    .ntz-acf-iconSelector-preview img {
      max-width:100%;
      height:auto;
      vertical-align:top;
    }
    </style>
    <?php
  }


  protected function show_javascript(){
    ?>
    <script type="text/javascript">
      jQuery(document).ready(function($){
        $(document).on('change', '.ntz-acf-iconSelectorShowPreview', function(){
          var iconClass = $('option:selected', this).data('preview');

          var icon = $('<span class="' + iconClass+ '"></span>');
          $('.ntz-acf-iconSelector-preview', $(this).parent() ).empty().append( icon );
        });
        $('.ntz-acf-iconSelectorShowPreview').trigger('change');
      });
    </script>

    <?php
  }
}

new IconSelector();