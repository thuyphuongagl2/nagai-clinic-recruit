<?php
class Submenu_Wrap extends Walker_Nav_Menu{
	
	var $sub_wrap = false;
	
	function __construct($sub_wrap= false){
		$this->sub_wrap = $sub_wrap;
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent         = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

        // Passed Classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        //$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . '">';
        $output .= $indent . '<li class="' . $class_names . ' menu__item">';

        // If 'noLink', 'lv2' exists in classes
		$target = array('noLink', 'lv2');
        $item_output ="";
		if(count(array_intersect($classes, $target)) == count($target)){
			// all of $target is in $classes
			$href = !empty($item->url) ? str_replace('[url]',substr(site_url(), strpos(site_url(),'://')+3),$item->url) : $item->url;
            $item_output = '<a class="menu__title pc_only" href="'.$href.'">'.apply_filters( 'the_title', $item->title, $item->ID ) .'</a>';
            $item_output .= '<p class="menu__title sp_only">'.apply_filters( 'the_title', $item->title, $item->ID ) .'</p>';
		}
		else if(count(array_intersect($classes, $target)) > 0){
			// at least one of $target is in $classes
			$href = !empty($item->url) ? str_replace('[url]',substr(site_url(), strpos(site_url(),'://')+3),$item->url) : $item->url;
            $item_output .= '<p class="menu__title">'.apply_filters( 'the_title', $item->title, $item->ID ) .'</p>';
		}
		else {
			$home_url = substr(site_url(), strpos(site_url(),'://')+3);
            // link attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			//$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( str_replace('[url]',site_url(),$item->url))  .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . str_replace('[url]',$home_url,$item->url)  .'"' : '';
            $attributes .= ' class="' . ( $depth > 0 ? 'sub__menu__link' : 'menu__link' ) . '"';

            $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                $args->before,
                $attributes,
                $args->link_before,
                apply_filters( 'the_title', $item->title, $item->ID ),
                $args->link_after,
                $args->after
            );
        }

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
	
    function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		if($this->sub_wrap == 'pc') {
			$output .= "\n$indent<div class='subInner'><ul class='sub__menu'>\n";
		}
		else{
			$output .= "\n$indent<ul>\n";
		}
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		if($this->sub_wrap == 'pc') {
			$output .= "$indent</ul></div>\n";
		}
		else{
			$output .= "$indent</ul>\n";
		}
    }
} 
?>