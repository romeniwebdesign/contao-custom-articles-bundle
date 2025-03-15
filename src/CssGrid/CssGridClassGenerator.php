<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\CssGrid;

use Rwd\ContaoCustomArticlesBundle\Config\CustomArticlesConfig;

/**
 * Generates CSS Grid classes and styles.
 */
class CssGridClassGenerator
{
    private CustomArticlesConfig $config;

    public function __construct(CustomArticlesConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Generate CSS Grid container styles.
     */
    public function generateGridContainerStyles(array $options): string
    {
        $styles = [];

        // Basic grid container
        $styles[] = 'display: grid;';

        // Grid template columns based on the grid_xs value
        if (isset($options['grid_xs']) && '' !== $options['grid_xs'] && '-1' !== $options['grid_xs']) {
            $columns = (int) $options['grid_xs'];
            if ($columns > 0) {
                $styles[] = 'grid-template-columns: repeat('.$columns.', 1fr);';
            }
        }

        // Grid gap
        $styles[] = 'gap: 1rem;';

        return implode(' ', $styles);
    }

    /**
     * Generate CSS Grid item styles.
     */
    public function generateGridItemStyles(array $options): string
    {
        $styles = [];

        // Grid column span
        if (isset($options['grid_xs']) && '' !== $options['grid_xs'] && '-1' !== $options['grid_xs']) {
            $styles[] = 'grid-column: span '.$options['grid_xs'].';';
        }

        // Grid row span (if needed)
        if (isset($options['grid_row_span']) && '' !== $options['grid_row_span'] && '0' !== $options['grid_row_span']) {
            $styles[] = 'grid-row: span '.$options['grid_row_span'].';';
        }

        // Responsive grid column spans
        $breakpoints = [
            'sm' => $this->config->getBreakpoint('sm'),
            'md' => $this->config->getBreakpoint('md'),
            'lg' => $this->config->getBreakpoint('lg'),
            'xl' => $this->config->getBreakpoint('xl'),
        ];

        foreach ($breakpoints as $breakpoint => $value) {
            $optionName = 'grid_'.$breakpoint;
            if (isset($options[$optionName]) && '' !== $options[$optionName] && '-1' !== $options[$optionName]) {
                $styles[] = '@media (min-width: '.$value.'px) { grid-column: span '.$options[$optionName].'; }';
            }
        }

        return implode(' ', $styles);
    }

    /**
     * Generate CSS Grid alignment styles.
     */
    public function generateGridAlignmentStyles(array $options): string
    {
        $styles = [];

        // Horizontal alignment
        if (isset($options['col_align']) && '' !== $options['col_align']) {
            switch ($options['col_align']) {
                case 'float-left':
                case 'float-start':
                    $styles[] = 'justify-self: start;';
                    break;
                case 'mx-auto':
                    $styles[] = 'justify-self: center;';
                    break;
                case 'float-right':
                case 'float-end':
                    $styles[] = 'justify-self: end;';
                    break;
                case 'float-none':
                    $styles[] = 'justify-self: auto;';
                    break;
            }
        }

        // Vertical alignment
        if (isset($options['col_valign']) && '' !== $options['col_valign']) {
            switch ($options['col_valign']) {
                case 'align-self-start':
                    $styles[] = 'align-self: start;';
                    break;
                case 'align-self-center':
                    $styles[] = 'align-self: center;';
                    break;
                case 'align-self-end':
                    $styles[] = 'align-self: end;';
                    break;
            }
        }

        return implode(' ', $styles);
    }

    /**
     * Generate CSS Grid order styles.
     */
    public function generateGridOrderStyles(array $options): string
    {
        $styles = [];

        // Order
        if (isset($options['order_xs']) && '' !== $options['order_xs'] && '-1' !== $options['order_xs']) {
            $styles[] = 'order: '.$options['order_xs'].';';
        }

        // Responsive order
        $breakpoints = [
            'sm' => $this->config->getBreakpoint('sm'),
            'md' => $this->config->getBreakpoint('md'),
            'lg' => $this->config->getBreakpoint('lg'),
            'xl' => $this->config->getBreakpoint('xl'),
        ];

        foreach ($breakpoints as $breakpoint => $value) {
            $optionName = 'order_'.$breakpoint;
            if (isset($options[$optionName]) && '' !== $options[$optionName] && '-1' !== $options[$optionName]) {
                $styles[] = '@media (min-width: '.$value.'px) { order: '.$options[$optionName].'; }';
            }
        }

        return implode(' ', $styles);
    }

    /**
     * Generate all CSS Grid styles for an element.
     */
    public function generateAllStyles(array $options, bool $isContainer = false): string
    {
        if ($isContainer) {
            return $this->generateGridContainerStyles($options);
        }

        $gridItemStyles = $this->generateGridItemStyles($options);
        $alignmentStyles = $this->generateGridAlignmentStyles($options);
        $orderStyles = $this->generateGridOrderStyles($options);

        $allStyles = array_filter([
            $gridItemStyles,
            $alignmentStyles,
            $orderStyles,
        ]);

        return implode(' ', $allStyles);
    }

    /**
     * Generate CSS Grid classes.
     */
    public function generateGridClasses(array $options): string
    {
        $classes = [];

        // Basic grid classes
        $classes[] = 'css-grid-item';

        // Visibility classes
        if (isset($options['grid_visible']) && is_array($options['grid_visible'])) {
            foreach ($options['grid_visible'] as $visibilityClass) {
                if (strpos($visibilityClass, 'd-') === 0) {
                    $classes[] = $visibilityClass;
                }
            }
        }

        if (isset($options['grid_hidden']) && is_array($options['grid_hidden'])) {
            foreach ($options['grid_hidden'] as $hiddenClass) {
                if (strpos($hiddenClass, 'd-') === 0) {
                    $classes[] = $hiddenClass;
                }
            }
        }

        return implode(' ', $classes);
    }
}
