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

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\StringUtil;
use Rwd\ContaoCustomArticlesBundle\Bootstrap\BootstrapClassGenerator;
use Rwd\ContaoCustomArticlesBundle\Config\CustomArticlesConfig;
use Rwd\ContaoCustomArticlesBundle\CssGrid\CssGridClassGenerator;
use Rwd\ContaoCustomArticlesBundle\Library\HexToRgba;
use Rwd\ContaoCustomArticlesBundle\Template\TemplateRegistry;

#[Hook('compileArticle')]
class CompileArticleListener
{
    private HexToRgba $hexToRgba;
    private CustomArticlesConfig $config;
    private BootstrapClassGenerator $bootstrapClassGenerator;
    private CssGridClassGenerator $cssGridClassGenerator;

    private TemplateRegistry $templateRegistry;

    public function __construct(
        HexToRgba $hexToRgba,
        CustomArticlesConfig $config,
        BootstrapClassGenerator $bootstrapClassGenerator,
        CssGridClassGenerator $cssGridClassGenerator,
        TemplateRegistry $templateRegistry
    ) {
        $this->hexToRgba = $hexToRgba;
        $this->config = $config;
        $this->bootstrapClassGenerator = $bootstrapClassGenerator;
        $this->cssGridClassGenerator = $cssGridClassGenerator;
        $this->templateRegistry = $templateRegistry;
    }

    public function __invoke(FrontendTemplate $template, array $data, Module $module): void
    {
        $customTemplate = $this->templateRegistry->getTemplate('mod_article_custom');
        $count = \count($template->elements);

        // Extract article options
        $options = $this->extractArticleOptions($template);

        // Determine container type based on configuration
        $containertype = $this->determineContainerType($options);

        // Process visibility classes
        $this->processVisibilityClasses($template, $module);

        // Generate custom CSS
        $customcss = $this->generateCustomCss($template, $options);

        // Add accessibility attributes
        $this->addAccessibilityAttributes($template, $module);

        // We don't need to process content elements here anymore
        // The standard Contao template system will handle this
        // We just need to make sure the article template has the right classes

        // Process content elements to add Bootstrap grid classes
        if ($this->config->isBootstrap5Enabled() && !empty($template->elements)) {
            foreach ($template->elements as $key => $element) {
                // Add Bootstrap grid classes to content elements
                if (isset($element->grid_xs) && !empty($element->grid_xs)) {
                    $element->class .= ' col-' . $element->grid_xs;
                }
                if (isset($element->grid_sm) && !empty($element->grid_sm)) {
                    $element->class .= ' col-sm-' . $element->grid_sm;
                }
                if (isset($element->grid_md) && !empty($element->grid_md)) {
                    $element->class .= ' col-md-' . $element->grid_md;
                }
                if (isset($element->grid_lg) && !empty($element->grid_lg)) {
                    $element->class .= ' col-lg-' . $element->grid_lg;
                }
                if (isset($element->grid_xl) && !empty($element->grid_xl)) {
                    $element->class .= ' col-xl-' . $element->grid_xl;
                }

                // Update the element in the template
                $template->elements[$key] = $element;
            }
        }

        // Set template data
        $template->customcss = $customcss;
        $template->customclasses = $template->article_margin;
        $template->gridcount = $count;
        $template->containertype = $containertype;

        // Add element_css_classes for Twig templates in Contao 5.x
        $template->element_css_classes = $template->customclasses;

        // If dark mode is enabled, add the class
        if ($this->config->isDarkModeEnabled()) {
            $template->class .= ' ' . $this->bootstrapClassGenerator->generateDarkModeClass();
        }

        $customTemplate->setData($template->getData());
        $module->Template = $customTemplate;
    }

    /**
     * Extract article options from the template.
     */
    private function extractArticleOptions(FrontendTemplate $template): array
    {
        return [
            'article_color' => StringUtil::deserialize($template->article_color),
            'article_width' => StringUtil::deserialize($template->article_width),
            'article_minheight' => StringUtil::deserialize($template->article_minheight),
            'article_image' => $template->article_image,
            'article_image_position' => $template->article_image_position,
            'article_image_repeat' => $template->article_image_repeat,
            'article_image_cover' => $template->article_image_cover,
            'article_image_fixed' => $template->article_image_fixed,
            'inner_article_width' => StringUtil::deserialize($template->inner_article_width),
            'inner_article_space' => $template->inner_article_space,
            'inner_article_overflow' => $template->inner_article_overflow,
            'inner_article_color' => StringUtil::deserialize($template->inner_article_color),
            'inner_article_minheight' => StringUtil::deserialize($template->inner_article_minheight),
        ];
    }

    /**
     * Determine container type based on configuration.
     */
    private function determineContainerType(array $options): string
    {
        if ($this->config->isBootstrap5Enabled()) {
            return $this->bootstrapClassGenerator->generateContainerClass($options);
        }

        // Default container type logic
        if (isset($options['article_width']['value']) && '' !== $options['article_width']['value']) {
            if (100 === (int) $options['article_width']['value'] && preg_match('/%|vw/', $options['article_width']['unit'])) {
                return 'container-fluid';
            }
        }

        return 'container';
    }

    /**
     * Process visibility classes.
     */
    private function processVisibilityClasses(FrontendTemplate $template, Module $module): void
    {
        // Process article_visible
        if ('' !== $template->article_visible) {
            $tmpclasses = $module->cssID;
            $article_visible = @unserialize($template->article_visible);

            if ('b:0;' === $article_visible || false !== $article_visible) {
                foreach (StringUtil::deserialize($template->article_visible) as $value) {
                    // Convert Bootstrap 4 classes to Bootstrap 5 if enabled
                    if ($this->config->isBootstrap5Enabled() && in_array($value, ['visible-xs', 'visible-sm', 'visible-md', 'visible-lg'])) {
                        switch ($value) {
                            case 'visible-xs':
                                $tmpclasses[1] .= ' d-block d-sm-none';
                                break;
                            case 'visible-sm':
                                $tmpclasses[1] .= ' d-none d-sm-block d-md-none';
                                break;
                            case 'visible-md':
                                $tmpclasses[1] .= ' d-none d-md-block d-lg-none';
                                break;
                            case 'visible-lg':
                                $tmpclasses[1] .= ' d-none d-lg-block d-xl-none';
                                break;
                        }
                    } else {
                        $tmpclasses[1] .= ' '.$value;
                    }
                }
            } else {
                // Convert Bootstrap 4 classes to Bootstrap 5 if enabled
                if ($this->config->isBootstrap5Enabled() && in_array($template->article_visible, ['visible-xs', 'visible-sm', 'visible-md', 'visible-lg'])) {
                    switch ($template->article_visible) {
                        case 'visible-xs':
                            $tmpclasses[1] .= ' d-block d-sm-none';
                            break;
                        case 'visible-sm':
                            $tmpclasses[1] .= ' d-none d-sm-block d-md-none';
                            break;
                        case 'visible-md':
                            $tmpclasses[1] .= ' d-none d-md-block d-lg-none';
                            break;
                        case 'visible-lg':
                            $tmpclasses[1] .= ' d-none d-lg-block d-xl-none';
                            break;
                    }
                } else {
                    $tmpclasses[1] .= ' '.$template->article_visible;
                }
            }
            $module->cssID = $tmpclasses;
        }

        // Process article_hidden
        if ('' !== $template->article_hidden) {
            $tmpclasses = $module->cssID;
            $article_hidden = @unserialize($template->article_hidden);

            if ('b:0;' === $article_hidden || false !== $article_hidden) {
                foreach (StringUtil::deserialize($template->article_hidden) as $value) {
                    // Convert Bootstrap 4 classes to Bootstrap 5 if enabled
                    if ($this->config->isBootstrap5Enabled() && in_array($value, ['hidden-xs', 'hidden-sm', 'hidden-md', 'hidden-lg'])) {
                        switch ($value) {
                            case 'hidden-xs':
                                $tmpclasses[1] .= ' d-none d-sm-block';
                                break;
                            case 'hidden-sm':
                                $tmpclasses[1] .= ' d-block d-sm-none d-md-block';
                                break;
                            case 'hidden-md':
                                $tmpclasses[1] .= ' d-block d-md-none d-lg-block';
                                break;
                            case 'hidden-lg':
                                $tmpclasses[1] .= ' d-block d-lg-none d-xl-block';
                                break;
                        }
                    } else {
                        $tmpclasses[1] .= ' '.$value;
                    }
                }
            } else {
                // Convert Bootstrap 4 classes to Bootstrap 5 if enabled
                if ($this->config->isBootstrap5Enabled() && in_array($template->article_hidden, ['hidden-xs', 'hidden-sm', 'hidden-md', 'hidden-lg'])) {
                    switch ($template->article_hidden) {
                        case 'hidden-xs':
                            $tmpclasses[1] .= ' d-none d-sm-block';
                            break;
                        case 'hidden-sm':
                            $tmpclasses[1] .= ' d-block d-sm-none d-md-block';
                            break;
                        case 'hidden-md':
                            $tmpclasses[1] .= ' d-block d-md-none d-lg-block';
                            break;
                        case 'hidden-lg':
                            $tmpclasses[1] .= ' d-block d-lg-none d-xl-block';
                            break;
                    }
                } else {
                    $tmpclasses[1] .= ' '.$template->article_hidden;
                }
            }
            $module->cssID = $tmpclasses;
        }
    }

    /**
     * Generate custom CSS.
     */
    private function generateCustomCss(FrontendTemplate $template, array $options): string
    {
        $article_color = $options['article_color'];
        $article_width = $options['article_width'];
        $article_minheight = $options['article_minheight'];
        $article_image = $options['article_image'];
        $article_image_position = $options['article_image_position'];
        $article_image_repeat = $options['article_image_repeat'];
        $article_image_cover = $options['article_image_cover'];
        $article_image_fixed = $options['article_image_fixed'];
        $inner_article_width = $options['inner_article_width'];
        $inner_article_space = $options['inner_article_space'];
        $inner_article_overflow = $options['inner_article_overflow'];
        $inner_article_color = $options['inner_article_color'];
        $inner_article_minheight = $options['inner_article_minheight'];

        $customcss = ".mod_article.section_$template->id { ";

        // Article width
        if (isset($article_width['value']) && '' !== $article_width['value']) {
            $customcss .= 'width:'.$article_width['value'].$article_width['unit'].' !important;';
            $customcss .= 'max-width:'.$article_width['value'].$article_width['unit'].' !important;';
        }

        // Article min-height
        if (isset($article_minheight['value']) && '' !== $article_minheight['value']) {
            $customcss .= 'min-height:'.$article_minheight['value'].$article_minheight['unit'].' !important;';
        }

        // Article background color
        if (isset($article_color[0]) && '' !== $article_color[0]) {
            $customcss .= 'background-color:'.$this->hexToRgba->convertColors($article_color[0], (float) $article_color[1]).' !important;';
        }

        // Article background image
        if (isset($article_image) && '' !== $article_image) {
            // If responsive images are enabled, use picture element
            if ($this->config->isResponsiveImagesEnabled()) {
                $customcss .= "background-image:url('".$article_image."') !important;";
                $customcss .= "@media (max-width: ".$this->config->getBreakpoint('sm')."px) {";
                $customcss .= "background-image:url('".$article_image."') !important;";
                $customcss .= "}";
            } else {
                $customcss .= "background-image:url('".$article_image."') !important;";
            }
        }

        // Article background image repeat
        if (isset($article_image_repeat) && '' !== $article_image_repeat) {
            $customcss .= 'background-repeat:'.$article_image_repeat.' !important;';
        }

        // Article background image position
        if (isset($article_image_position) && '' !== $article_image_position) {
            $customcss .= 'background-position:'.$article_image_position.' !important;';
        }

        // Article background image cover
        if ($article_image_cover) {
            $customcss .= "background-size: cover !important;";

            if ($article_image_fixed) {
                $customcss .= 'background-attachment: fixed !important;';
            } else {
                $customcss .= 'background-attachment: initial !important;';
            }
        }

        // Article spacing
        if (isset($inner_article_space) && '' !== $inner_article_space) {
            $defaultSpacing = $this->config->getDefaultSpacing();

            if ('no_spaceing' === $inner_article_space) {
                $customcss .= 'padding-bottom:0 !important;';
                $customcss .= 'padding-top:0 !important;';
            }

            if ('top_spaceing' === $inner_article_space) {
                $customcss .= 'padding-top:'.$defaultSpacing.'px !important;';
            }

            if ('bottom_spaceing' === $inner_article_space) {
                $customcss .= 'padding-bottom:'.$defaultSpacing.'px !important;';
            }

            if ('top_bottom_space' === $inner_article_space) {
                $customcss .= 'padding-bottom:'.$defaultSpacing.'px !important;';
                $customcss .= 'padding-top:'.$defaultSpacing.'px !important;';
            }
        }

        $customcss .= ' } ';

        // Article min-height inheritance
        if (isset($article_minheight['value']) && '' !== $article_minheight['value']) {
            $customcss .= ".mod_article.section_$template->id > * { min-height:inherit; }";
            $customcss .= ".mod_article.section_$template->id > * > * { min-height:inherit; }";
        }

        // Section content styles
        $customcss .= ".mod_article.section_$template->id .section_content { ";

        // Inner article background color
        if (isset($inner_article_color[0]) && '' !== $inner_article_color[0]) {
            $customcss .= 'background-color:'.$this->hexToRgba->convertColors($inner_article_color[0], (float) $inner_article_color[1]).' !important;';
        }

        // Inner article width
        if (isset($inner_article_width['value']) && '' !== $inner_article_width['value']) {
            $customcss .= 'width:'.$inner_article_width['value'].$inner_article_width['unit'].' !important;';
            $customcss .= 'max-width:'.$inner_article_width['value'].$inner_article_width['unit'].' !important;';
        }

        // Inner article min-height
        if (isset($inner_article_minheight['value']) && '' !== $inner_article_minheight['value']) {
            $customcss .= 'min-height:'.$inner_article_minheight['value'].$inner_article_minheight['unit'].' !important; display:block;';
        }

        $customcss .= ' } ';

        // Row styles
        $customcss .= ".mod_article.section_$template->id .section_content > .row { ";

        // Inner article overflow
        if (isset($inner_article_overflow) && '' !== $inner_article_overflow) {
            if ('overflow_hidden' === $inner_article_overflow) {
                $customcss .= 'overflow:hidden !important;';
            }

            if ('overflow_visible' === $inner_article_overflow) {
                $customcss .= 'overflow:visible !important;';
            }
        }

        $customcss .= ' } ';

        // Add CSS Grid styles if enabled
        if ($this->config->isCssGridEnabled()) {
            $customcss .= ".mod_article.section_$template->id .css-grid-container { ";
            $customcss .= $this->cssGridClassGenerator->generateGridContainerStyles($options);
            $customcss .= ' } ';
        }

        // Add dark mode styles if enabled
        if ($this->config->isDarkModeEnabled()) {
            $customcss .= ".dark-mode .mod_article.section_$template->id { ";
            $customcss .= 'color: #fff;';
            $customcss .= 'background-color: #333;';
            $customcss .= ' } ';

            if (isset($inner_article_color[0]) && '' !== $inner_article_color[0]) {
                $customcss .= ".dark-mode .mod_article.section_$template->id .section_content { ";
                $customcss .= 'background-color:'.$this->hexToRgba->convertColors('#333333', (float) $inner_article_color[1]).' !important;';
                $customcss .= ' } ';
            }
        }

        return $customcss;
    }

    /**
     * Add accessibility attributes.
     */
    private function addAccessibilityAttributes(FrontendTemplate $template, Module $module): void
    {
        // Add role attribute if not present
        if (!isset($module->attributes) || false === strpos($module->attributes, 'role=')) {
            $module->attributes = ($module->attributes ?? '') . ' role="region"';
        }

        // Add aria-label with article title if available
        if (!empty($template->headline)) {
            $module->attributes = ($module->attributes ?? '') . ' aria-labelledby="article-' . $template->id . '"';
        }
    }

}
