<?php

class ElementorAdSystemStore
{
  public static $globalProperties = array(
    'template',
    'countdown_year',
    'countdown_month',
    'countdown_day',
    'countdown_hour',
    'countdown_min',
    'countdown_sec',
  );

  public $id = false;

  function __construct($id)
  {
    $this->id = $id;
  }

  /**
   * Magic getter to simplify this object
   */
  function __get($name)
  {
    if (in_array($name, self::$globalProperties)) {
      return get_post_meta($this->id, $name, true);
    }
    return new WP_Error('invalid_get_property', "The requested property '$name' does not exist for " . __CLASS__);
  }

  /**
   * Magic setter to simplify this object
   */
  function __set($name, $value)
  {
    if (in_array($name, self::$globalProperties)) {
      return update_post_meta($this->id, $name, $value);
    }
    return new WP_Error('invalid_set_property', "The requested property '$name' does not exist for " . __CLASS__);
  }

  function save_all($POST)
  {
    foreach (self::$globalProperties as $prop) {
      $this->{$prop} = $POST[$prop];
    }
  }
}
