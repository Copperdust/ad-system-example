# Elementor Ad System

This plugin creates a Elementor Block that allows the user to add countdown ads anywhere on the content. It is extensible to allow for theme developers to add other types of ads.

# Getting Started

## Developing

1. Clone repository
2. Install dependencies `$ npm install`
3. Run `$ gulp watch` to watch and compile src/index.js and src/scss/main.scss
4. Run `$ gulp build` to build production ready assets

## Installation (environment)

### Manual

Install WordPress with your preferred method, and once you have it running:

1. Go into `wp-content/plugins` and clone this repository
2. Enable plugin

### Premade

1. Clone `https://github.com/Copperdust/wordpress-quick-start`
2. Install docker/docker-compose dependencies
3. Run `$ docker-compose up`
4. Go into `wp-content/plugins` and clone this repository
5. Enable plugin

## Testing

### Ads

This plugin requires at least one Ad to be configured. Ads are a custom post type that have a config for each separate Ad. This allows different countdowns to be used in different places, and still have all settings accessible from a single place. The Ad defines the Template and template configurations, which is currently only the countdown deadline.

### Elementor

Elementor needs to be installed and running prior to the activation of this plugin

### Adding to a page

Insert the widget from the Basic tab into the content. On the sidebar, there are two settings:

1. Ad: This is the Ad we want this widget to represent, it's a drop down with search that lists all the Ads post type's titles ("Type")
2. Title: This is the title that is applied to the individual instance of the widget

### Extending templates

You need to use two hooks for this:

1. "eas_register_custom_templates"

This filter needs to get a list of `slug => Name` for custom templates. E.g.

```
add_filter('eas_register_custom_templates', function($templates) {
  $templates['debug-settings'] = 'Debug Settings';
  return $templates;
});
```

2. eas_render_template_[template]

This hook is called when trying to render the registered template. E.g.

```
add_action('eas_render_template_debug-settings', function($settings) {
  print_r($settings);
});
```

# Decision Log

## BEM

We're using BEM classes to avoid clutter in CSS/SCSS files

## Supported max width of ad: 710px

We need to assume that this ad can be put in the content of any theme which can have any content well size. The designs used for the ad use a 710px well, and while it's possible to add media queries to improve the style on larger resolutions, it's faster for this test to focus on the mobile aspects, which were explicitly mentioned. In a real-life case, designs for larger screens would be necessary.

The main issue with supporting arbitrary resolution sizes is that media queries cannot be used due to the element being in the main content, which is different on different themes. In the example of twenty-twenty, the post detail well is smaller than 710px, even though the screen can be, for instance, 1440px in width.

## CSS Variables

For easier customizability and extension in the future, all colors have been set as CSS variables.