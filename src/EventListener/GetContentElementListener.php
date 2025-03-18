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

use Contao\ContentModel;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\StringUtil;
use Rwd\ContaoCustomArticlesBundle\Bootstrap\BootstrapClassGenerator;
use Rwd\ContaoCustomArticlesBundle\Config\CustomArticlesConfig;
use Rwd\ContaoCustomArticlesBundle\CssGrid\CssGridClassGenerator;

#[AsHook('getContentElement')]
class GetContentElementListener
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

    public function __invoke(ContentModel $contentModel, string $buffer, $element): string
    {
        // Skip if buffer is empty
        if ('' === $buffer) {
            return $buffer;
        }
        
        // Skip certain templates
        $type = $contentModel->type;
        if (in_array($type, ['html', 'newRow'])) {
            return $buffer;
        }

        // Extract element options
        $options = $this->extractElementOptions($contentModel);
        
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
                // Find the style attribute in the buffer
                $stylePattern = '/<([a-z0-9]+)([^>]*?)style="([^"]*?)"([^>]*?)>/i';
                if (preg_match($stylePattern, $buffer, $styleMatches)) {
                    $styleTag = $styleMatches[1];
                    $styleBefore = $styleMatches[2];
                    $existingStyles = $styleMatches[3];
                    $styleAfter = $styleMatches[4];
                    
                    // Add our styles to the existing styles
                    $newStyles = $existingStyles . ' ' . $gridStyles;
                    
                    // Replace the style attribute
                    $styleReplacement = '<' . $styleTag . $styleBefore . 'style="' . $newStyles . '"' . $styleAfter . '>';
                    $buffer = preg_replace($stylePattern, $styleReplacement, $buffer, 1);
                } else {
                    // If no style attribute exists, add it to the first tag with a class attribute
                    $pattern = '/<([a-z0-9]+)([^>]*?)class="([^"]*?)"([^>]*?)>/i';
                    if (preg_match($pattern, $buffer, $matches)) {
                        $tag = $matches[1];
                        $before = $matches[2];
                        $existingClasses = $matches[3];
                        $after = $matches[4];
                        
                        // Add style attribute
                        $replacement = '<' . $tag . $before . 'class="' . $existingClasses . '"' . ' style="' . $gridStyles . '"' . $after . '>';
                        $buffer = preg_replace($pattern, $replacement, $buffer, 1);
                    }
                }
            }
        }
        
        // Add dark mode class if enabled
        if ($this->config->isDarkModeEnabled()) {
            $classes .= ' ' . $this->bootstrapClassGenerator->generateDarkModeClass();
        }
        
        // We don't need debug classes anymore
        $debugClass = '';
        
        // Add accessibility attributes
        $attributes = '';
        
        // Add role attribute
        $role = 'region';
        
        // Determine appropriate role based on template type
        if (strpos($type, 'text') === 0) {
            $role = 'article';
        } elseif (strpos($type, 'headline') === 0) {
            $role = 'heading';
        } elseif (strpos($type, 'image') === 0) {
            $role = 'img';
        } elseif (strpos($type, 'gallery') === 0) {
            $role = 'group';
        } elseif (strpos($type, 'list') === 0) {
            $role = 'list';
        } elseif (strpos($type, 'table') === 0) {
            $role = 'table';
        } elseif (strpos($type, 'form') === 0) {
            $role = 'form';
        }
        
        $attributes .= ' role="' . $role . '"';
        
        // Add aria-hidden for hidden elements
        if (isset($options['grid_hidden']) && !empty($options['grid_hidden'])) {
            $attributes .= ' aria-hidden="true"';
        }
        
        // Add the classes and attributes to the buffer
        if ('' !== $classes || '' !== $debugClass || '' !== $attributes) {
            // Find the first tag in the buffer
            $pattern = '/<([a-z0-9]+)([^>]*?)class="([^"]*?)"([^>]*?)>/i';
            if (preg_match($pattern, $buffer, $matches)) {
                $tag = $matches[1];
                $before = $matches[2];
                $existingClasses = $matches[3];
                $after = $matches[4];
                
                // Add our classes to the existing classes
                $newClasses = $existingClasses . $debugClass . $classes;
                
                // Replace the class attribute and add accessibility attributes
                $replacement = '<' . $tag . $before . 'class="' . $newClasses . '"' . $attributes . $after . '>';
                $buffer = preg_replace($pattern, $replacement, $buffer, 1);
            }
        }
        
        return $buffer;
    }
    
    /**
     * Extract element options into an array.
     */
    private function extractElementOptions(ContentModel $element): array
    {
        $options = [];
        
        // Grid options
        $gridOptions = ['grid_xs', 'grid_sm', 'grid_md', 'grid_lg', 'grid_xl'];
        foreach ($gridOptions as $option) {
            if (isset($element->$option) && '' !== $element->$option) {
                $options[$option] = $element->$option;
            }
        }
        
        // Offset options
        $offsetOptions = ['offset_xs', 'offset_sm', 'offset_md', 'offset_lg', 'offset_xl'];
        foreach ($offsetOptions as $option) {
            if (isset($element->$option) && '' !== $element->$option) {
                $options[$option] = $element->$option;
            }
        }
        
        // Order options
        $orderOptions = ['order_xs', 'order_sm', 'order_md', 'order_lg', 'order_xl'];
        foreach ($orderOptions as $option) {
            if (isset($element->$option) && '' !== $element->$option) {
                $options[$option] = $element->$option;
            }
        }
        
        // Push options (legacy)
        $pushOptions = ['push_xs', 'push_sm', 'push_md', 'push_lg'];
        foreach ($pushOptions as $option) {
            if (isset($element->$option) && '' !== $element->$option) {
                $options[$option] = $element->$option;
            }
        }
        
        // Visibility options
        if (isset($element->grid_visible) && '' !== $element->grid_visible) {
            $grid_visible = @unserialize($element->grid_visible);
            
            if ('b:0;' === $grid_visible || false !== $grid_visible) {
                $options['grid_visible'] = StringUtil::deserialize($element->grid_visible);
            } else {
                $options['grid_visible'] = [$element->grid_visible];
            }
        }
        
        if (isset($element->grid_hidden) && '' !== $element->grid_hidden) {
            $grid_hidden = @unserialize($element->grid_hidden);
            
            if ('b:0;' === $grid_hidden || false !== $grid_hidden) {
                $options['grid_hidden'] = StringUtil::deserialize($element->grid_hidden);
            } else {
                $options['grid_hidden'] = [$element->grid_hidden];
            }
        }
        
        // Alignment options
        if (isset($element->col_padding) && ('' !== $element->col_padding)) {
            $options['col_padding'] = $element->col_padding;
        }
        
        if (isset($element->col_margin) && ('' !== $element->col_margin)) {
            $options['col_margin'] = $element->col_margin;
        }
        
        if (isset($element->col_align) && ('' !== $element->col_align)) {
            $options['col_align'] = $element->col_align;
        }
        
        if (isset($element->col_valign) && ('' !== $element->col_valign)) {
            $options['col_valign'] = $element->col_valign;
        }
        
        return $options;
    }
}
