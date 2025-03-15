<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\StringUtil;
use Contao\Template;
use Rwd\ContaoCustomArticlesBundle\Bootstrap\BootstrapClassGenerator;
use Rwd\ContaoCustomArticlesBundle\Config\CustomArticlesConfig;
use Rwd\ContaoCustomArticlesBundle\CssGrid\CssGridClassGenerator;

#[Hook('parseTemplate')]
class ParseTemplateListener
{
    private CustomArticlesConfig $config;
    private BootstrapClassGenerator $bootstrapClassGenerator;
    private CssGridClassGenerator $cssGridClassGenerator;

    public function __construct(
        CustomArticlesConfig $config,
        BootstrapClassGenerator $bootstrapClassGenerator,
        CssGridClassGenerator $cssGridClassGenerator
    ) {
        $this->config = $config;
        $this->bootstrapClassGenerator = $bootstrapClassGenerator;
        $this->cssGridClassGenerator = $cssGridClassGenerator;
    }

    public function __invoke(Template $template): void
    {
        $templateName = $template->getName();

        if (
            '' !== $templateName
         && 'mod_html' !== $templateName
         && 'ce_newRow' !== $templateName
         && 'mod_newsreader' !== $templateName
         && 'news_full' !== $templateName
        ) {
            // Extract template properties into an options array
            $options = $this->extractTemplateOptions($template);
            
            // Generate classes based on configuration
            $classes = '';
            
            if ($this->config->isBootstrap5Enabled()) {
                $classes .= ' ' . $this->bootstrapClassGenerator->generateAllClasses($options);
            }
            
            if ($this->config->isCssGridEnabled()) {
                $classes .= ' ' . $this->cssGridClassGenerator->generateGridClasses($options);
                
                // Add inline CSS Grid styles if needed
                $gridStyles = $this->cssGridClassGenerator->generateAllStyles($options);
                if (!empty($gridStyles)) {
                    $template->style = ($template->style ?? '') . ' ' . $gridStyles;
                }
            }
            
            // Add dark mode class if enabled
            if ($this->config->isDarkModeEnabled()) {
                $classes .= ' ' . $this->bootstrapClassGenerator->generateDarkModeClass();
            }
            
            // Add ARIA attributes for accessibility
            $this->addAccessibilityAttributes($template, $options);

            if ('' !== $classes) {
                $template->class .= $classes;
            }
        }
    }
    
    /**
     * Extract template options into an array.
     */
    private function extractTemplateOptions(Template $template): array
    {
        $options = [];
        
        // Grid options
        $gridOptions = ['grid_xs', 'grid_sm', 'grid_md', 'grid_lg', 'grid_xl'];
        foreach ($gridOptions as $option) {
            if (isset($template->$option)) {
                $options[$option] = $template->$option;
            }
        }
        
        // Offset options
        $offsetOptions = ['offset_xs', 'offset_sm', 'offset_md', 'offset_lg', 'offset_xl'];
        foreach ($offsetOptions as $option) {
            if (isset($template->$option)) {
                $options[$option] = $template->$option;
            }
        }
        
        // Order options
        $orderOptions = ['order_xs', 'order_sm', 'order_md', 'order_lg', 'order_xl'];
        foreach ($orderOptions as $option) {
            if (isset($template->$option)) {
                $options[$option] = $template->$option;
            }
        }
        
        // Push options (legacy)
        $pushOptions = ['push_xs', 'push_sm', 'push_md', 'push_lg'];
        foreach ($pushOptions as $option) {
            if (isset($template->$option)) {
                $options[$option] = $template->$option;
            }
        }
        
        // Visibility options
        if ('' !== ($template->grid_visible ?? '')) {
            $grid_visible = @unserialize((string) $template->grid_visible);
            
            if ('b:0;' === $grid_visible || false !== $grid_visible) {
                $options['grid_visible'] = StringUtil::deserialize($template->grid_visible);
            } else {
                $options['grid_visible'] = [$template->grid_visible];
            }
        }
        
        if ('' !== ($template->grid_hidden ?? '')) {
            $grid_hidden = @unserialize((string) $template->grid_hidden);
            
            if ('b:0;' === $grid_hidden || false !== $grid_hidden) {
                $options['grid_hidden'] = StringUtil::deserialize($template->grid_hidden);
            } else {
                $options['grid_hidden'] = [$template->grid_hidden];
            }
        }
        
        // Alignment options
        if (isset($template->col_padding) && ('' !== $template->col_padding)) {
            $options['col_padding'] = $template->col_padding;
        }
        
        if (isset($template->col_margin) && ('' !== $template->col_margin)) {
            $options['col_margin'] = $template->col_margin;
        }
        
        if (isset($template->col_align) && ('' !== $template->col_align)) {
            $options['col_align'] = $template->col_align;
        }
        
        if (isset($template->col_valign) && ('' !== $template->col_valign)) {
            $options['col_valign'] = $template->col_valign;
        }
        
        return $options;
    }
    
    /**
     * Add ARIA attributes for accessibility.
     */
    private function addAccessibilityAttributes(Template $template, array $options): void
    {
        // Add role attribute if not present
        if (!isset($template->attributes) || false === strpos($template->attributes, 'role=')) {
            $role = 'region';
            
            // Determine appropriate role based on template name
            if (strpos($template->getName(), 'ce_text') === 0) {
                $role = 'article';
            } elseif (strpos($template->getName(), 'ce_headline') === 0) {
                $role = 'heading';
            } elseif (strpos($template->getName(), 'ce_image') === 0) {
                $role = 'img';
            } elseif (strpos($template->getName(), 'ce_gallery') === 0) {
                $role = 'group';
            } elseif (strpos($template->getName(), 'ce_list') === 0) {
                $role = 'list';
            } elseif (strpos($template->getName(), 'ce_table') === 0) {
                $role = 'table';
            } elseif (strpos($template->getName(), 'ce_form') === 0) {
                $role = 'form';
            }
            
            $template->attributes = ($template->attributes ?? '') . ' role="' . $role . '"';
        }
        
        // Add aria-hidden for hidden elements
        if (isset($options['grid_hidden']) && !empty($options['grid_hidden'])) {
            $template->attributes = ($template->attributes ?? '') . ' aria-hidden="true"';
        }
    }
}
