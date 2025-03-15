# Contao Custom Articles Bundle Documentation

This bundle enhances Contao's article and content element functionality with Bootstrap 5 support, CSS Grid, and various other modern features.

## Installation

```bash
composer require romeniwebdesign/contao-custom-articles-bundle
```

## Configuration

The bundle can be configured in your `config/config.yaml` file:

```yaml
# Default configuration
contao_custom_articles:
    enable_bootstrap5: true
    include_bootstrap_cdn: true
    enable_css_grid: true
    enable_flexbox: true
    enable_dark_mode: false
    spacing:
        default_spacing: 100
        custom_spacings: []
    responsive:
        enable_responsive_images: true
        breakpoints:
            xs: 0
            sm: 576
            md: 768
            lg: 992
            xl: 1200
            xxl: 1400
```

### Configuration Options

- **enable_bootstrap5**: Enable Bootstrap 5 support (default: true)
- **include_bootstrap_cdn**: Include Bootstrap 5 CSS and JS from CDN (default: true)
- **enable_css_grid**: Enable CSS Grid support (default: true)
- **enable_flexbox**: Enable Flexbox utilities (default: true)
- **enable_dark_mode**: Enable dark mode support (default: false)
- **spacing**: Configure spacing options
- **responsive**: Configure responsive options

### Bootstrap CDN

When both `enable_bootstrap5` and `include_bootstrap_cdn` are set to `true`, the bundle automatically includes Bootstrap 5 CSS and JS from a CDN (jsDelivr). This makes it easy to use Bootstrap 5 without having to manually include it in your layout.

The following files are included:
- CSS: https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
- JS: https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js

If you prefer to include Bootstrap yourself or are already including it in your layout, you can disable the CDN by setting `include_bootstrap_cdn` to `false`.

## Features

### Bootstrap 5 Integration

The bundle provides full Bootstrap 5 support for articles and content elements:

- Grid system with columns, offsets, and ordering
- Responsive visibility classes
- Spacing utilities
- Alignment options

### CSS Grid Support

In addition to Bootstrap's grid system, the bundle also supports CSS Grid:

- Grid container and item styles
- Responsive grid layouts
- Grid alignment options

### Flexbox Utilities

The bundle includes Flexbox utilities for advanced layouts:

- Flex container and item styles
- Alignment options
- Order and direction controls

### Dark Mode

The bundle includes optional dark mode support:

- Dark mode toggle
- Automatic dark mode based on system preferences
- Custom dark mode styles for articles and content elements

### Responsive Features

The bundle includes responsive features:

- Responsive images
- Responsive visibility
- Responsive spacing
- Customizable breakpoints

### Accessibility Improvements

The bundle includes accessibility improvements:

- ARIA attributes
- Semantic HTML
- Screen reader support
- Keyboard navigation

### Twig Templates

The bundle includes Twig templates for all components:

- Article templates
- Content element templates
- Custom row templates

## Usage

### Article Options

The bundle adds the following options to articles:

- Width and minimum height
- Background color with opacity
- Background image with positioning options
- Responsive visibility
- Spacing options
- Inner article options

### Content Element Options

The bundle adds the following options to content elements:

- Grid column sizes for different breakpoints
- Offsets and ordering
- Visibility options
- Alignment options
- Spacing options

### New Row Element

The bundle includes a special content element for creating new rows:

1. Create a new content element
2. Select "New Row" as the element type
3. Save the element

This will create a new Bootstrap row, allowing you to create complex layouts within articles.

## Examples

### Basic Article with Background

```php
// In your Contao backend
// 1. Create a new article
// 2. Set the background color to #f5f5f5 with 100% opacity
// 3. Set the width to 100%
// 4. Set the inner article width to 1200px
// 5. Add your content elements
```

### Responsive Content Layout

```php
// In your Contao backend
// 1. Create a new article
// 2. Add a content element
// 3. Set the grid column sizes:
//    - XS: 12
//    - SM: 6
//    - MD: 4
//    - LG: 3
// 4. Add more content elements with similar settings
```

### Using the New Row Element

```php
// In your Contao backend
// 1. Create a new article
// 2. Add content elements for the first row
// 3. Add a "New Row" element
// 4. Add content elements for the second row
```

## Upgrading from Bootstrap 4

If you're upgrading from Bootstrap 4, the bundle will automatically convert Bootstrap 4 classes to Bootstrap 5 equivalents:

- `visible-xs` → `d-block d-sm-none`
- `visible-sm` → `d-none d-sm-block d-md-none`
- `visible-md` → `d-none d-md-block d-lg-none`
- `visible-lg` → `d-none d-lg-block d-xl-none`
- `hidden-xs` → `d-none d-sm-block`
- `hidden-sm` → `d-block d-sm-none d-md-block`
- `hidden-md` → `d-block d-md-none d-lg-block`
- `hidden-lg` → `d-block d-lg-none d-xl-block`
- `float-left` → `float-start`
- `float-right` → `float-end`

## Troubleshooting

### Common Issues

- **CSS not loading**: Make sure you have Bootstrap 5 included in your layout
- **Grid not working**: Check if the grid options are set correctly
- **Visibility classes not working**: Make sure you're using the correct Bootstrap 5 classes

### Support

If you encounter any issues, please create an issue on GitHub:
https://github.com/romeniwebdesign/contao-custom-articles-bundle/issues
