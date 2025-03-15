# Contao Custom Articles Bundle

This bundle enhances Contao's article and content element functionality with Bootstrap 5 support, CSS Grid, and various other modern features.

## Features

- **Bootstrap 5 Integration**: Full support for Bootstrap 5 grid system, utilities, and components
- **CSS Grid Support**: Modern CSS Grid layouts alongside Bootstrap
- **Flexbox Utilities**: Advanced layout options with Flexbox
- **Dark Mode**: Optional dark mode support
- **Responsive Features**: Responsive images, visibility, and spacing
- **Accessibility Improvements**: ARIA attributes, semantic HTML, and screen reader support
- **Twig Templates**: Modern Twig templates alongside traditional PHP templates

## Requirements

- PHP 8.1+
- Contao 5.0+
- Bootstrap 5 (recommended)

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

## Documentation

For detailed documentation, see the [docs](docs/index.md).

## Upgrading from Bootstrap 4

If you're upgrading from Bootstrap 4, the bundle will automatically convert Bootstrap 4 classes to Bootstrap 5 equivalents. See the [documentation](docs/index.md#upgrading-from-bootstrap-4) for details.

## License

This bundle is licensed under the LGPL-3.0-or-later license.
