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

  /**
   * This function will automatically save all properties based on an array of key/value items
   */
  public function save_all($values)
  {
    foreach (self::$globalProperties as $prop) {
      if (isset($values[$prop])) $this->{$prop} = $values[$prop];
    }
  }

  /**
   * Return DateTime object automatically
   */
  public function get_countdown_date_time()
  {
    return new DateTime(
      $this->countdown_year . '-' .
        $this->countdown_month . '-' .
        $this->countdown_day . ' ' .
        $this->countdown_hour . ':' .
        $this->countdown_min . ':' .
        $this->countdown_sec
    );
  }
}
