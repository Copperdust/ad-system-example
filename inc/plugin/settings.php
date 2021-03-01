<?php

class ElementorAdSystemSettingsPage {
  function __construct() {
    self::register_settings_page();
  }

  public static function register_settings_page() {
    $pages = array(
      'elementor-ad-system'	=> array(
        'page_title'	=> __( 'Elementor Ad System', 'sample-domain' ),
        'sections'		=> array(
          'section-one'	=> array(
            'title'			=> __( 'Pick', 'sample-domain' ),
            'fields'		=> array(
              'default'		=> array(
                'title'			=> __( 'Default (text)', 'sample-domain' ),
                'text'			=> __( 'Text attributes are used as help text for most input types.' ),
              ),
              'date'			=> array(
                'title'			=> __( 'Date', 'sample-domain' ),
                'type'			=> 'date',
                'value'			=> 'now',
              ),
              'datetime'		=> array(
                'title'			=> __( 'Datetime-Local', 'sample-domain' ),
                'type'			=> 'datetime-local',
                'value'			=> 'now',
              ),
              'datetime-local' => array(
                'title'			=> __( 'Datetime-Local', 'sample-domain' ),
                'type'			=> 'datetime-local',
                'value'			=> 'now',
              ),
              'email'			=> array(
                'title'			=> __( 'Email', 'sample-domain' ),
                'type'			=> 'email',
                'placeholder'	=> 'email.address@domain.com',
              ),
              'month'			=> array(
                'title'			=> __( 'Month', 'sample-domain' ),
                'type'			=> 'month',
                'value'			=> 'now',
              ),
              'number'		=> array(
                'title'			=> __( 'Number', 'sample-domain' ),
                'type'			=> 'number',
                'value'			=> 42,
              ),
              'password'		=> array(
                'title'			=> __( 'Password', 'sample-domain' ),
                'type'			=> 'password',
              ),
              'search'		=> array(
                'title'			=> __( 'Search', 'sample-domain' ),
                'type'			=> 'search',
                'placeholder'	=> __( 'Keywords or terms&hellip;', 'sample-domain' ),
              ),
              'tel'			=> array(
                'title'			=> __( 'Telephone', 'sample-domain' ),
                'type'			=> 'tel',
                'placeholder'	=> '(555) 555-5555',
              ),
              'time'			=> array(
                'title'			=> __( 'Time', 'sample-domain' ),
                'type'			=> 'time',
                'value'			=> 'now',
              ),
              'url'			=> array(
                'title'			=> __( 'URL', 'sample-domain' ),
                'type'			=> 'url',
                'placeholder'	=> 'http://jeremyhixon.com',
              ),
              'week'			=> array(
                'title'			=> __( 'Week', 'sample-domain' ),
                'type'			=> 'week',
                'value'			=> 'now',
              ),
            ),
          ),
          'section-two'	=> array(
            'title'			=> __( 'Non-standard Input', 'sample-domain' ),
            'fields'		=> array(
              'checkbox'		=> array(
                'title'			=> __( 'Checkbox', 'sample-domain' ),
                'type'			=> 'checkbox',
                'text'			=> __( 'Text attributes are used as labels for checkboxes' ),
              ),
              'color'			=> array(
                'title'			=> __( 'Color', 'sample-domain' ),
                'type'			=> 'color',
                'value'			=> '#cc0000',
              ),
              'media'			=> array(
                'title'			=> __( 'Media', 'sample-domain' ),
                'type'			=> 'media',
                'value'			=> 'http://your-domain.com/wp-content/uploads/2016/01/sample.jpg',
              ),
              'radio'			=> array(
                'title'			=> __( 'Radio', 'sample-domain' ),
                'type'			=> 'radio',
                'value'			=> 'option-two',
                'choices'		=> array(
                  'option-one'	=> __( 'Option One', 'sample-domain' ),
                  'option-two'	=> __( 'Option Two', 'sample-domain' ),
                ),
              ),
              'range'			=> array(
                'title'			=> __( 'Range', 'sample-domain' ),
                'type'			=> 'range',
                'value'			=> 75,
              ),
              'select'		=> array(
                'title'			=> __( 'Select', 'sample-domain' ),
                'type'			=> 'select',
                'value'			=> 'option-two',
                'choices'		=> array(
                  'option-one'	=> __( 'Option One', 'sample-domain' ),
                  'option-two'	=> __( 'Option Two', 'sample-domain' ),
                ),
              ),
              'select-multiple'		=> array(
                'title'			=> __( 'Select multiple', 'sample-domain' ),
                'type'			=> 'select',
                'value' => array(
                  'option-two'
                ),
                'choices' => array(
                  'option-one' => __( 'Option One', 'sample-domain' ),
                  'option-two' => __( 'Option Two', 'sample-domain' ),
                  'option-three' => __( 'Option Three', 'sample-domain' ),
                ),
                'attributes' => array(
                  'multiple' => 'multiple'
                ),
                'sanitize' => true
              ),
              'textarea'		=> array(
                'title'			=> __( 'Textarea', 'sample-domain' ),
                'type'			=> 'textarea',
                'value'			=> 'Pellentesque consectetur volutpat lectus, ac molestie lorem molestie nec. Vestibulum in auctor massa. Vivamus convallis nunc quis lacus maximus, non ultricies risus gravida. Praesent ac diam imperdiet, volutpat nisi sed, semper eros. In nec orci hendrerit, laoreet nunc eu, semper magna. Curabitur eu lorem a enim sodales consequat. Vestibulum eros nunc, congue sed blandit in, maximus eu tellus.',
              ),
              'wp_editor'		=> array(
                'title'			=> __( 'WP Editor', 'sample-domain' ),
                'type'			=> 'wp_editor',
                'value'			=> 'Pellentesque consectetur volutpat lectus, ac molestie lorem molestie nec. Vestibulum in auctor massa. Vivamus convallis nunc quis lacus maximus, non ultricies risus gravida. Praesent ac diam imperdiet, volutpat nisi sed, semper eros. In nec orci hendrerit, laoreet nunc eu, semper magna. Curabitur eu lorem a enim sodales consequat. Vestibulum eros nunc, congue sed blandit in, maximus eu tellus.',
              ),
            ),
          ),
        ),
      ),
    );
    $option_page = new RationalOptionPages( $pages );

  }
}
