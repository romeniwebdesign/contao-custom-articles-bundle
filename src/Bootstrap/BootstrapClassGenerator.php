<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Bootstrap;

use Rwd\ContaoCustomArticlesBundle\Config\CustomArticlesConfig;

/**
 * Generates Bootstrap 5 classes for grid and layout.
 */
class BootstrapClassGenerator
{
    private CustomArticlesConfig $config;

    public function __construct(CustomArticlesConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Generate column classes for Bootstrap 5.
     */
    public function generateColumnClasses(array $options): string
    {
        $classes = [];

        // Column sizes
        if (isset($options['grid_xs']) && '' !== $options['grid_xs'] && '-1' !== $options['grid_xs']) {
            $classes[] = 'col-'.$options['grid_xs'];
        }

        if (isset($options['grid_sm']) && '' !== $options['grid_sm'] && '-1' !== $options['grid_sm']) {
            $classes[] = 'col-sm-'.$options['grid_sm'];
        }

        if (isset($options['grid_md']) && '' !== $options['grid_md'] && '-1' !== $options['grid_md']) {
            $classes[] = 'col-md-'.$options['grid_md'];
        }

        if (isset($options['grid_lg']) && '' !== $options['grid_lg'] && '-1' !== $options['grid_lg']) {
            $classes[] = 'col-lg-'.$options['grid_lg'];
        }

        if (isset($options['grid_xl']) && '' !== $options['grid_xl'] && '-1' !== $options['grid_xl']) {
            $classes[] = 'col-xl-'.$options['grid_xl'];
        }

        // Offsets
        if (isset($options['offset_xs']) && '' !== $options['offset_xs'] && '-1' !== $options['offset_xs']) {
            $classes[] = 'offset-'.$options['offset_xs'];
        }

        if (isset($options['offset_sm']) && '' !== $options['offset_sm'] && '-1' !== $options['offset_sm']) {
            $classes[] = 'offset-sm-'.$options['offset_sm'];
        }

        if (isset($options['offset_md']) && '' !== $options['offset_md'] && '-1' !== $options['offset_md']) {
            $classes[] = 'offset-md-'.$options['offset_md'];
        }

        if (isset($options['offset_lg']) && '' !== $options['offset_lg'] && '-1' !== $options['offset_lg']) {
            $classes[] = 'offset-lg-'.$options['offset_lg'];
        }

        if (isset($options['offset_xl']) && '' !== $options['offset_xl'] && '-1' !== $options['offset_xl']) {
            $classes[] = 'offset-xl-'.$options['offset_xl'];
        }

        // Order
        if (isset($options['order_xs']) && '' !== $options['order_xs'] && '-1' !== $options['order_xs']) {
            $classes[] = 'order-'.$options['order_xs'];
        }

        if (isset($options['order_sm']) && '' !== $options['order_sm'] && '-1' !== $options['order_sm']) {
            $classes[] = 'order-sm-'.$options['order_sm'];
        }

        if (isset($options['order_md']) && '' !== $options['order_md'] && '-1' !== $options['order_md']) {
            $classes[] = 'order-md-'.$options['order_md'];
        }

        if (isset($options['order_lg']) && '' !== $options['order_lg'] && '-1' !== $options['order_lg']) {
            $classes[] = 'order-lg-'.$options['order_lg'];
        }

        if (isset($options['order_xl']) && '' !== $options['order_xl'] && '-1' !== $options['order_xl']) {
            $classes[] = 'order-xl-'.$options['order_xl'];
        }

        return implode(' ', $classes);
    }

    /**
     * Generate visibility classes for Bootstrap 5.
     */
    public function generateVisibilityClasses(array $options): string
    {
        $classes = [];

        // Visible classes (Bootstrap 5 uses d-* classes)
        if (isset($options['grid_visible']) && is_array($options['grid_visible'])) {
            foreach ($options['grid_visible'] as $visibilityClass) {
                // Convert Bootstrap 4 visibility classes to Bootstrap 5
                switch ($visibilityClass) {
                    case 'visible-xs':
                        $classes[] = 'd-block d-sm-none';
                        break;
                    case 'visible-sm':
                        $classes[] = 'd-none d-sm-block d-md-none';
                        break;
                    case 'visible-md':
                        $classes[] = 'd-none d-md-block d-lg-none';
                        break;
                    case 'visible-lg':
                        $classes[] = 'd-none d-lg-block d-xl-none';
                        break;
                    default:
                        // If it's already a Bootstrap 5 class, use it as is
                        if (strpos($visibilityClass, 'd-') === 0) {
                            $classes[] = $visibilityClass;
                        }
                        break;
                }
            }
        }

        // Hidden classes (Bootstrap 5 uses d-* classes)
        if (isset($options['grid_hidden']) && is_array($options['grid_hidden'])) {
            foreach ($options['grid_hidden'] as $hiddenClass) {
                // Convert Bootstrap 4 hidden classes to Bootstrap 5
                switch ($hiddenClass) {
                    case 'hidden-xs':
                        $classes[] = 'd-none d-sm-block';
                        break;
                    case 'hidden-sm':
                        $classes[] = 'd-block d-sm-none d-md-block';
                        break;
                    case 'hidden-md':
                        $classes[] = 'd-block d-md-none d-lg-block';
                        break;
                    case 'hidden-lg':
                        $classes[] = 'd-block d-lg-none d-xl-block';
                        break;
                    default:
                        // If it's already a Bootstrap 5 class, use it as is
                        if (strpos($hiddenClass, 'd-') === 0) {
                            $classes[] = $hiddenClass;
                        }
                        break;
                }
            }
        }

        return implode(' ', $classes);
    }

    /**
     * Generate alignment classes for Bootstrap 5.
     */
    public function generateAlignmentClasses(array $options): string
    {
        $classes = [];

        // Horizontal alignment
        if (isset($options['col_align']) && '' !== $options['col_align']) {
            // Convert Bootstrap 4 float classes to Bootstrap 5 equivalents
            switch ($options['col_align']) {
                case 'float-left':
                    $classes[] = 'float-start';
                    break;
                case 'float-right':
                    $classes[] = 'float-end';
                    break;
                case 'mx-auto':
                case 'float-none':
                    $classes[] = $options['col_align']; // These remain the same in Bootstrap 5
                    break;
                default:
                    $classes[] = $options['col_align'];
                    break;
            }
        }

        // Vertical alignment
        if (isset($options['col_valign']) && '' !== $options['col_valign']) {
            $classes[] = $options['col_valign']; // These remain the same in Bootstrap 5
        }

        return implode(' ', $classes);
    }

    /**
     * Generate spacing classes for Bootstrap 5.
     */
    public function generateSpacingClasses(array $options): string
    {
        $classes = [];

        // Padding
        if (isset($options['col_padding']) && '' !== $options['col_padding']) {
            $classes[] = $options['col_padding'];
        }

        // Margin
        if (isset($options['col_margin']) && '' !== $options['col_margin']) {
            $classes[] = $options['col_margin'];
        }

        return implode(' ', $classes);
    }

    /**
     * Generate all Bootstrap 5 classes for an element.
     */
    public function generateAllClasses(array $options): string
    {
        $columnClasses = $this->generateColumnClasses($options);
        $visibilityClasses = $this->generateVisibilityClasses($options);
        $alignmentClasses = $this->generateAlignmentClasses($options);
        $spacingClasses = $this->generateSpacingClasses($options);

        $allClasses = array_filter([
            $columnClasses,
            $visibilityClasses,
            $alignmentClasses,
            $spacingClasses,
        ]);

        return implode(' ', $allClasses);
    }

    /**
     * Generate container class based on width.
     */
    public function generateContainerClass(array $options): string
    {
        if (isset($options['article_width']['value']) && '' !== $options['article_width']['value']) {
            if (100 === (int) $options['article_width']['value'] && preg_match('/%|vw/', $options['article_width']['unit'])) {
                return 'container-fluid';
            }
        }

        return 'container';
    }

    /**
     * Generate dark mode class if enabled.
     */
    public function generateDarkModeClass(): string
    {
        if ($this->config->isDarkModeEnabled()) {
            return 'dark-mode';
        }

        return '';
    }
}
