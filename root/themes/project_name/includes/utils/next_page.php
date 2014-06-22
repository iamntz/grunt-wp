<?php
/*
  Plugin Name: PageAdjacentSiblings
  Plugin URI: n/a
  Description: Get immediate previous/next URLs for pages, return false if there is no sibling
  Version: 1.0
  Author: Ionuț Staicu.
  Author URI: http://iamntz.com
*/

/*
  === Usage ===
  $pageAdjacentSiblings = new PageAdjacentSiblings();

  To get just links for prev/next pages:
  if ( $previousPageLink = $pageSiblings->get_previous_page_link() ){
    echo $previousPageLink;
  }

  if ( $nextPageLink = $pageSiblings->get_next_page_link() ){
    echo $nextPageLink;
  }

  To get the page object:
  if ( $previousPage = $pageSiblings->get_previous_page() ){
    var_dump( $previousPage );
  }

  if ( $nextPage = $pageSiblings->get_next_page() ){
    var_dump( $nextPage );
  }
*/


class PageAdjacentSiblings {
  protected $ancestors;
  protected $siblings;
  protected $current_page_order;
  protected $options;
  protected $parent;
  protected $adjacent_siblings = array();


  function __construct( $post = null, $options = array() ) {
    if( !$post ){
      global $post;
    }

    $this->options = array_merge( array(
      "sort_column" => "menu_order",
      "sort_order"  => "asc",
      "loop"        => false, //  TODO: add the ability to return first page when you are viewing last page and viceverse
    ), $options );

    $this->current_page_order = $post->{$this->options['sort_column']};
    $this->ancestors          = get_post_ancestors($post->ID);
    $this->parent             = !$post->post_parent ? 0 : $this->ancestors[ count( $this->ancestors ) - 1 ];

    $this->siblings = get_pages( array(
      "child_of"    => $this->parent,
      "parent"      => $this->parent,
      "sort_column" => $this->options['sort_column'],
      "sort_order"  => $this->options['sort_order']
    ) );


    foreach( (array) $this->siblings as $sibling ){
      if( $sibling->{$this->options['sort_column']} < $this->current_page_order ){
        $this->adjacent_siblings['prev'] = $sibling;
      }

      if( !isset( $this->adjacent_siblings['next'] ) && $sibling->{$this->options['sort_column']} > $this->current_page_order ){
        $this->adjacent_siblings['next'] = $sibling;
      }
    }
  }


  public function get_previous_page(){
    return ( isset( $this->adjacent_siblings['prev'] ) ? $this->adjacent_siblings['prev'] : false );
  } // get_previous_page


  public function get_next_page(){
    return ( isset( $this->adjacent_siblings['next'] ) ? $this->adjacent_siblings['next'] : false );
  } // get_next_page


  public function get_previous_page_link(){
    if( $previousPage = $this->get_previous_page() ){
      return get_permalink( $previousPage->ID );
    }
  } // get_next_page_link


  public function get_next_page_link(){
    if( $nextPage = $this->get_next_page() ){
      return get_permalink( $nextPage->ID );
    }
  } // get_next_page_link
}