<?php

class ElementorAdSystemTemplates
{
  use Singleton;

  function init()
  {
    $this->plugin_templates = $this->get_templates_from_folder(ElementorAdSystem::plugin_dir_path('inc/templates'));
    $this->register_templates();
  }

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

  public function register_templates()
  {
    foreach ($this->plugin_templates as $name => $path) {
      add_action('eas_render_template_' . $name, array($this, 'render'));
    }
  }

  public function template_exists($check)
  {
    foreach ($this->plugin_templates as $name => $path) {
      if ($name === $check) {
        return true;
      }
    }
    return false;
  }

  public function render($settings)
  {
    if (empty($settings['ad']))
      throw new WP_Error('eas_ad_not_selected', 'Elementor Ad System - You must select an Ad to render', $settings);

    $store = new ElementorAdSystemStore($settings['ad']);
    $template = $store->template;

    if ($this->template_exists($template)) {
      $datetime = $store->get_countdown_date_time();
      $diff = $datetime->diff(new DateTime('now'));

      require $this->plugin_templates[$template];
    } else {
      do_action('eas_render_template_' . $template, $settings);
    }
  }
}
