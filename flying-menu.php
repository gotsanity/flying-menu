<?php
/*
Plugin Name: Flying-Menu Widget
Plugin URI: http://www.insidiousdesigns.net/flying-menu/
Description: Creates a widget for a menu that flies in from off screen. Uses jquery.
Author: gotsanity
Version: 1.0
Author URI: http://www.insidiousdesigns.net/
*/
 
 
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
    echo "<h1>This is my new widget!</h1>";
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("FlyingMenuWidget");') );?>
