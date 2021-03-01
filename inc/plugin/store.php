<?php

class ElementorAdSystemStore {
  public static $globalProperties = array(
    'template',
    'countdown_days',
    'countdown_hours',
    'countdown_mins',
    'countdown_secs',
  );

  public $id = false;

  function __construct( $id ) {
    $this->id = $id;
  }

  function __get( $name ) {
    if ( in_array( $name, self::$globalProperties ) ) {
      return get_post_meta( $this->id, $name, true );
    }
    return new WP_Error('invalid_get_property', "The requested property '$name' does not exist for ".__CLASS__);
  }

  function __set( $name, $value ) {
    if ( in_array( $name, self::$globalProperties ) ) {
      return update_post_meta( $this->id, $name, $value );
    }
    return new WP_Error('invalid_set_property', "The requested property '$name' does not exist for ".__CLASS__);
  }
}
