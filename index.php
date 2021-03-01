<?php

/**
 * Plugin Name: Elementor Ad System
 * Plugin URI: https://github.com/Copperdust/ad-system-example
 * Description: This plugin creates a Elementor Block that allows the user to add countdown ads anywhere on the content. It is extensible to allow for theme developers to add other types of ads.
 * Version: 1.0
 */

require_once plugin_dir_path(__FILE__) . "/inc/plugin/singleton.php";
require_once plugin_dir_path(__FILE__) . "/inc/plugin/store.php";
require_once plugin_dir_path(__FILE__) . "/inc/plugin/post_type.php";
// require_once plugin_dir_path(__FILE__)."/inc/plugin/settings.php";

// require_once plugin_dir_path(__FILE__)."/vendor/RationalOptionPages/RationalOptionPages.php";

class ElementorAdSystem
{
  use Singleton;

  protected function init()
  {
    // Register actions; this head is only meant to be used for this test, bad practive in a real life case
    add_action('wp_head', array($this, 'register_custom_fonts'));

    // Register Elementor widget
    add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);

    // Init post type
    $this->PostType = new ElementorAdSystemPostType();
  }

  /**
   * This function is only used for this test, in a real life case, including a google font within a plugin is bad practice.
   */
  public function register_custom_fonts()
  {
?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
<?php
  }

  /**
   * Register out widget
   */
  public function register_widgets()
  {
    require_once self::plugin_dir_path('/inc/widget/index.php');
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new ElementorAdSystem_Widget());
  }

  /**
   * Helper function for dependencies, as plugin_dir_path only does a "trailingslashit" on the "dirname"
   */
  public static function plugin_dir_path($path)
  {
    return plugin_dir_path(__FILE__) . $path;
  }

  /**
   * Same thing for plugins_url
   */
  public static function plugins_url($path)
  {
    return plugins_url($path, __FILE__);
  }
}

ElementorAdSystem::getInstance();
