<?php

class ElementorAdSystem_Widget extends \Elementor\Widget_Base
{

  public function __construct($data = [], $args = null)
  {
    parent::__construct($data, $args);

    wp_register_script('eas-script', ElementorAdSystem::plugins_url('/dist/main.js'), ['elementor-frontend'], '1.0.0', true);
    wp_register_style('eas-style', ElementorAdSystem::plugins_url('/dist/main.css'));
  }

  public function get_script_depends()
  {
    return ['eas-script'];
  }

  public function get_style_depends()
  {
    return ['eas-style'];
  }

  public function get_name()
  {
    return "ad-system";
  }

  public function get_title()
  {
    return "Ad System";
  }

  public function get_icon()
  {
    return 'fa fa-code';
  }

  public function get_categories()
  {
    return ['basic'];
  }

  protected function _register_controls()
  {
    $this->start_controls_section(
      'settings_sections',
      [
        'label' => 'Settings',
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $query = new WP_Query(
      array(
        'post_type'      => ElementorAdSystemPostType::$post_type,
        'posts_per_page' => -1
      )
    );
    $posts_array = $query->posts;
    $post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID');

    $this->add_control(
      'ad',
      [
        'label' => 'Ad',
        'type' => \Elementor\Controls_Manager::SELECT2,
        'options' => $post_title_array,
      ]
    );

    $this->add_control(
      'title',
      [
        'label' => 'Title',
        'type' => \Elementor\Controls_Manager::TEXT,
      ]
    );

    $this->end_controls_section();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();

    require 'template.php';
  }

  protected function _content_template()
  {
    return;
  }
}
