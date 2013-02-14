<?php
/*
Plugin Name: Flying-Menu Widget
Plugin URI: http://www.insidiousdesigns.net/flying-menu/
Description: Creates a widget for a menu that flies in from off screen. Uses jquery.
Author: gotsanity
Version: 1.0
Author URI: http://www.insidiousdesigns.net/
*/

// ************************
// Enqueue the stylesheet and jquery plugin

	wp_enqueue_script('jquery-1.9.1', plugins_url('/js/jquery-1.9.1.min.js', __FILE__ ), array( 'jquery' ), '1.9.1', true );
	wp_enqueue_script('flying-menu-script', plugins_url('/js/flying-menu.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_enqueue_style('flying-menu-style', plugins_url( 'styles/flying-menu.css', __FILE__ ), array(), '1.0' );



// **********************
// Build FlyingMenuWidget Class
 
class FlyingMenuWidget extends WP_Widget
{
  function FlyingMenuWidget()
  {
    $widget_ops = array('classname' => 'FlyingMenuWidget', 'description' => 'Displays a jquery enabled menu that flies in from off screen' );
    $this->WP_Widget('FlyingMenuWidget', 'Flying Menu', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
    // WIDGET CODE GOES HERE
	wp_nav_menu( array( 'menu' => 'flying-menu', 'menu_class' => 'flying-menu', 'container_class' => 'flying-menu-block' ) );

    // Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
    // This code based on wp_nav_menu's code to get Menu ID from menu slug
/*
    $menu_name = 'short';

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

	$menu_items = wp_get_nav_menu_items($menu->term_id);

	$menu_list = '<ul id="menu-' . $menu_name . '">';

	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $title = $menu_item->title;
	    $url = $menu_item->url;
	    $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
	}
	$menu_list .= '</ul>';
    } else {
	$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
    }
    // $menu_list now ready to output

	echo $menu_list; */

    echo $after_widget;
  }

}

add_action( 'widgets_init', create_function('', 'return register_widget("FlyingMenuWidget");') );?>
