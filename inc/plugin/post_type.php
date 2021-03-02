<?php

class ElementorAdSystemPostType
{
  public static $post_type = 'as-ad';

  function __construct()
  {
    add_action('init', array(__CLASS__, 'register_post_type'));

    add_action('add_meta_boxes', array(__CLASS__, 'add_meta_boxes'));
    add_action('save_post_' . self::$post_type, array(__CLASS__, 'save_custom_data'));
  }

  public static function register_post_type()
  {
    // Register Custom Post Type Ad
    $labels = array(
      'name' => _x('Ads', 'Post Type General Name', 'elementor-ad-system'),
      'singular_name' => _x('Ad', 'Post Type Singular Name', 'elementor-ad-system'),
      'menu_name' => _x('Ads', 'Admin Menu text', 'elementor-ad-system'),
      'name_admin_bar' => _x('Ad', 'Add New on Toolbar', 'elementor-ad-system'),
      'archives' => __('Ad Archives', 'elementor-ad-system'),
      'attributes' => __('Ad Attributes', 'elementor-ad-system'),
      'parent_item_colon' => __('Parent Ad:', 'elementor-ad-system'),
      'all_items' => __('All Ads', 'elementor-ad-system'),
      'add_new_item' => __('Add New Ad', 'elementor-ad-system'),
      'add_new' => __('Add New', 'elementor-ad-system'),
      'new_item' => __('New Ad', 'elementor-ad-system'),
      'edit_item' => __('Edit Ad', 'elementor-ad-system'),
      'update_item' => __('Update Ad', 'elementor-ad-system'),
      'view_item' => __('View Ad', 'elementor-ad-system'),
      'view_items' => __('View Ads', 'elementor-ad-system'),
      'search_items' => __('Search Ad', 'elementor-ad-system'),
      'not_found' => __('Not found', 'elementor-ad-system'),
      'not_found_in_trash' => __('Not found in Trash', 'elementor-ad-system'),
      'featured_image' => __('Featured Image', 'elementor-ad-system'),
      'set_featured_image' => __('Set featured image', 'elementor-ad-system'),
      'remove_featured_image' => __('Remove featured image', 'elementor-ad-system'),
      'use_featured_image' => __('Use as featured image', 'elementor-ad-system'),
      'insert_into_item' => __('Insert into Ad', 'elementor-ad-system'),
      'uploaded_to_this_item' => __('Uploaded to this Ad', 'elementor-ad-system'),
      'items_list' => __('Ads list', 'elementor-ad-system'),
      'items_list_navigation' => __('Ads list navigation', 'elementor-ad-system'),
      'filter_items_list' => __('Filter Ads list', 'elementor-ad-system'),
    );
    $args = array(
      'label' => __('Ad', 'elementor-ad-system'),
      'description' => __('', 'elementor-ad-system'),
      'labels' => $labels,
      'menu_icon' => '',
      'supports' => array('title'),
      'taxonomies' => array(),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 5,
      'show_in_admin_bar' => true,
      'show_in_nav_menus' => true,
      'can_export' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'exclude_from_search' => false,
      'show_in_rest' => true,
      'publicly_queryable' => false,
      'capability_type' => 'post',
    );
    register_post_type(self::$post_type, $args);
  }

  public static function add_meta_boxes()
  {
    $screens = [self::$post_type];
    foreach ($screens as $screen) {
      add_meta_box(
        self::$post_type . '-custom-fields',                 // Unique ID
        'Ad Options',      // Box title
        array(__CLASS__, "render_meta_box"),  // Content callback, must be of type callable
        $screen                            // Post type
      );
    }
  }

  public static function option($compareValue, $optionValue, $optionText)
  {
?>
    <option <?php echo ($compareValue === $optionValue) ? 'selected' : '' ?> value="<?php echo $optionValue ?>"><?php echo $optionText ?></option>
    <?
  }

  public function render_meta_box($post)
  {
    $store = new ElementorAdSystemStore($post->ID);
?>
    <style>
      .countdown-input {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
      }

      .countdown-input__date-container,
      .countdown-input__time-container {
        display: flex;
        gap: 2px;
      }

      .countdown-input__item {
        max-width: 55px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }

      .countdown-input__item--year {
        max-width: 70px;
      }

      .countdown-input__item input {
        width: 100%;
      }

      @media (max-width: 782px) {
        .countdown-input__item {
          max-width: 60px;
        }

        .countdown-input__item--year {
          max-width: 75px;
        }
      }
    </style>
    <table class="form-table" role="presentation">
      <tr>
        <th scope="row"><label for="template">Template</label></th>
        <td>
          <select name="template" id="template">
            <?php self::option($store->template, '', 'Select a Template'); ?>
            <?php self::option($store->template, 'countdown', 'Countdown'); ?>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="countdown">Countdown</label></th>
        <td>
          <div class="countdown-input">
            <div class="countdown-input__date-container">
              <div class="countdown-input__item countdown-input__item--year">
                <label for="countdown_year">Year</label>
                <input type="number" name="countdown_year" value="<?php echo $store->countdown_year ?: date('Y') ?>" min="<?php echo date('Y') ?>">
              </div>
              <div class="countdown-input__item">
                <label for="countdown_month">Month</label>
                <input type="number" name="countdown_month" value="<?php echo $store->countdown_month ?: date('m') ?>" min="1" max="12">
              </div>
              <div class="countdown-input__item">
                <label for="countdown_day">Day</label>
                <input type="number" name="countdown_day" value="<?php echo $store->countdown_day ?: date('d') ?>" min="1" max="31">
              </div>
            </div>
            <div class="countdown-input__time-container">
              <div class="countdown-input__item">
                <label for="countdown_hour">Hour</label>
                <input type="number" name="countdown_hour" value="<?php echo $store->countdown_hour ?: date('H') ?>" min="0" max="23">
              </div>
              <div class="countdown-input__item">
                <label for="countdown_min">Min</label>
                <input type="number" name="countdown_min" value="<?php echo $store->countdown_min ?: date('i') ?>" min="0" max="59">
              </div>
              <div class="countdown-input__item">
                <label for="countdown_sec">Sec</label>
                <input type="number" name="countdown_sec" value="<?php echo $store->countdown_sec ?: date('s') ?>" min="0" max="59">
              </div>
            </div>
          </div>
        </td>
      </tr>
    </table>
<?php  }

  public function save_custom_data($post_id)
  {
    $store = new ElementorAdSystemStore($post_id);
    $store->save_all($_POST);
  }
}
