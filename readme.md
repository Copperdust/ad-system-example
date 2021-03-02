# Elementor Ad System

This plugin creates a Elementor Block that allows the user to add countdown ads anywhere on the content. It is extensible to allow for theme developers to add other types of ads.

# Extending templates

You need to use two hooks for this:

1.- "eas_register_custom_templates"

This filter needs to get a list of names for custom templates. E.g.

```
add_filter('eas_register_custom_templates', function($templates) {
  $templates[] = 'debug-settings';
  return $templates;
});
```

2.- eas_render_template_[template]

This hook is called when trying to render the registered template. E.g.

```
add_action('eas_render_template_debug-settings', function($settings) {
  print_r($settings);
});
```

# Getting Started

1.- Clone repository
2.- Install dependencies `$ npm install`
3.- Run `$ npm run dev:watch` to watch and compile src/index.js and src/scss/main.scss
4.- Run `$ npm run build` to build production ready assets

# Decision Log

## BEM

We're using BEM classes to avoid clutter in CSS/SCSS files

## Supported max width of ad: 710px

We need to assume that this ad can be put in the content of any theme which can have any content well size. The designs used for the ad use a 710px well, and while it's possible to add media queries to improve the style on larger resolutions, it's faster for this test to focus on the mobile aspects, which were explicitly mentioned. In a real-life case, designs for larger screens would be necessary.

The main issue with supporting arbitrary resolution sizes is that media queries cannot be used due to the element being in the main content, which is different on different themes. In the example of twenty-twenty, the post detail well is smaller than 710px, even though the screen can be, for instance, 1440px in width.

## CSS Variables

For easier customizability and extension in the future, all colors have been set as CSS variables.

