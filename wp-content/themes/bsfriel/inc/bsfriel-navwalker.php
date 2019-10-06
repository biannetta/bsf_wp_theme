<?php
class Bsfriel_Navwalker extends Walker_Nav_Menu {

  function start_el( &$output, $item, $depth=0, $args=array(), $id=0 ) {
    $object = $item->object;
    $type = $item->type;
    $title = $item->title;
    $permalink = $item->url;

    $output .= '<a href="'. $permalink .'" class="navbar__item navbar__item--impact">';
    $output .= '&nbsp;'.$title.'&nbsp;';
    $output .= '</a>';
  }

}
?>