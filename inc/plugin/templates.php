<?php

class ElementorAdSystemTemplates
{
  use Singleton;

  function init()
  {
    $this->plugin_templates = $this->get_templates_from_folder(ElementorAdSystem::plugin_dir_path('inc/templates'));
    $this->register_templates();
  }

  /**
   * Gets name+path from every php file in the plugins template folder
   */
  public function get_templates_from_folder($path)
  {
    $entries = array();
    $d = dir($path);
    while (false !== ($entry = $d->read())) {
      if (preg_match('/\.php$/', $entry)) {
        $entries[substr($entry, 0, -4)] = $path . '/' . $entry;
      }
    }
    $d->close();
    return $entries;
  }

  /**
   * Registers custom templates into this class. Currently useless.
   */
  public function register_templates()
  {
    $this->custom_templates = apply_filters( 'eas_register_custom_templates', array() );
  }

  /**
   * Checks if the template name is registered as one of the plugin's available templates
   */
  public function template_exists($check)
  {
    foreach ($this->plugin_templates as $name => $path) {
      if ($name === $check) {
        return true;
      }
    }
    return false;
  }

  /**
   * Main function. Renders the template used by the ad that's related to the widget instantiating this class
   */
  public function render($settings)
  {
    if (empty($settings['ad']))
      throw new WP_Error('eas_ad_not_selected', 'Elementor Ad System - You must select an Ad to render', $settings);

    $store = new ElementorAdSystemStore($settings['ad']);
    $template = $store->template;

    if ($this->template_exists($template)) {
      // Templates that come with the plugin by default

      /**
       * These variables are necessary for the "countdown" template.
       *
       * TODO: Make this section dynamic based on template. Unnecessary when there's only a single template.
       */
      $datetime = $store->get_countdown_date_time();
      $diff = $datetime->diff(new DateTime('now'));

      require $this->plugin_templates[$template];
    } else {
      // Custom templates
      do_action('eas_render_template_' . $template, $settings);
    }
  }
}
