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
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\StringUtil;
use Rwd\ContaoCustomArticlesBundle\Library\HexToRgba;

/**
 * @Hook("compileArticle")
 */
class CompileArticleListener
{
    /**
     * @var HexToRgba
     */
    private $hexToRgba;

    public function __construct(HexToRgba $hexToRgba)
    {
        $this->hexToRgba = $hexToRgba;
    }

    public function __invoke(FrontendTemplate $template, array $data, Module $module): void
    {
        $customTemplate = new FrontendTemplate('mod_article_custom');
        $count = \count($template->elements);

        $containertype = 'container';

        $article_color = StringUtil::deserialize($template->article_color);
        $article_width = StringUtil::deserialize($template->article_width);
        $article_minheight = StringUtil::deserialize($template->article_minheight);
        $article_image = $template->article_image;
        $article_image_position = $template->article_image_position;
        $article_image_repeat = $template->article_image_repeat;
        $article_image_cover = $template->article_image_cover;
        $article_image_fixed = $template->article_image_fixed;

        $inner_article_width = StringUtil::deserialize($template->inner_article_width);
        $inner_article_space = $template->inner_article_space;
        $inner_article_overflow = $template->inner_article_overflow;
        $inner_article_color = StringUtil::deserialize($template->inner_article_color);
        $inner_article_minheight = StringUtil::deserialize($template->inner_article_minheight);

        if ('' !== $template->article_visible) {
            $tmpclasses = $module->cssID;
            $article_visible = @unserialize($template->article_visible);

            if ('b:0;' === $article_visible || false !== $article_visible) {
                foreach (StringUtil::deserialize($template->article_visible) as $value) {
                    $tmpclasses[1] .= ' '.$value;
                }
            } else {
                $tmpclasses[1] .= ' '.$template->article_visible;
            }
            $module->cssID = $tmpclasses;
        }

        if ('' !== $template->article_hidden) {
            $tmpclasses = $module->cssID;
            $article_hidden = @unserialize($template->article_hidden);

            if ('b:0;' === $article_hidden || false !== $article_hidden) {
                foreach (StringUtil::deserialize($template->article_hidden) as $value) {
                    $tmpclasses[1] .= ' '.$value;
                }
            } else {
                $tmpclasses[1] .= ' '.$template->article_hidden;
            }
            $module->cssID = $tmpclasses;
        }

        $customcss = ".mod_article.section_$template->id { ";

        if (isset($article_width['value']) && '' !== $article_width['value']) {
            if (100 === (int) $article_width['value'] && preg_match('/%|vw/', $article_width['unit'])) {
                $containertype = 'container-fluid';
            } else {
                $containertype = 'container';
            }
            $customcss .= 'width:'.$article_width['value'].$article_width['unit'].' !important;';
            $customcss .= 'max-width:'.$article_width['value'].$article_width['unit'].' !important;';
        }

        if (isset($article_minheight['value']) && '' !== $article_minheight['value']) {
            $customcss .= 'min-height:'.$article_minheight['value'].$article_minheight['unit'].' !important;';
        }

        if (isset($article_color[0]) && '' !== $article_color[0]) {
            $customcss .= 'background-color:'.$this->hexToRgba->convertColors($article_color[0], (float) $article_color[1]).' !important;';
        }

        if (isset($article_image) && '' !== $article_image) {
            $customcss .= "background-image:url('".$article_image."') !important;";
        }

        if (isset($article_image_repeat) && '' !== $article_image_repeat) {
            $customcss .= 'background-repeat:'.$article_image_repeat.' !important;';
        }

        if (isset($article_image_position) && '' !== $article_image_position) {
            $customcss .= 'background-position:'.$article_image_position.' !important;';
        }

        if ($article_image_cover) {
            $customcss .= "
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=$img-uri, sizingMethod='scale');
					-ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=$img-uri, sizingMethod='scale') !important;";

            if ($article_image_fixed) {
                $customcss .= 'background-attachment: fixed;';
            } else {
                $customcss .= 'background-attachment: initial;';
            }
        }

        if (isset($inner_article_space) && '' !== $inner_article_space) {
            if ('no_spaceing' === $inner_article_space) {
                $customcss .= 'padding-bottom:0 !important;';
                $customcss .= 'padding-top:0 !important;';
            }

            if ('top_spaceing' === $inner_article_space) {
                $customcss .= 'padding-top:100px !important;';
            }

            if ('bottom_spaceing' === $inner_article_space) {
                $customcss .= 'padding-bottom:100px !important;';
            }

            if ('top_bottom_space' === $inner_article_space) {
                $customcss .= 'padding-bottom:100px !important;';
                $customcss .= 'padding-top:100px !important;';
            }
        }

        $customcss .= ' } ';

        if (isset($article_minheight['value']) && '' !== $article_minheight['value']) {
            $customcss .= ".mod_article.section_$template->id > * { min-height:inherit; }";
            $customcss .= ".mod_article.section_$template->id > * > * { min-height:inherit; }";
        }
        $customcss .= ".mod_article.section_$template->id .section_content { ";

        if (isset($inner_article_color[0]) && '' !== $inner_article_color[0]) {
            $customcss .= 'background-color:'.$this->hexToRgba->convertColors($inner_article_color[0], (float) $inner_article_color[1]).' !important;';
        }

        if (isset($inner_article_width['value']) && '' !== $inner_article_width['value']) {
            $customcss .= 'width:'.$inner_article_width['value'].$inner_article_width['unit'].' !important;';
            $customcss .= 'max-width:'.$inner_article_width['value'].$inner_article_width['unit'].' !important;';
        }

        if (isset($inner_article_minheight['value']) && '' !== $inner_article_minheight['value']) {
            $customcss .= 'min-height:'.$inner_article_minheight['value'].$inner_article_minheight['unit'].' !important; display:block;';
        }
        $customcss .= ' } ';
        $customcss .= ".mod_article.section_$template->id .section_content > .row { ";

        if (isset($inner_article_overflow) && '' !== $inner_article_overflow) {
            if ('overflow_hidden' === $inner_article_overflow) {
                $customcss .= 'overflow:hidden !important;';
            }

            if ('overflow_visible' === $inner_article_overflow) {
                $customcss .= 'overflow:visible !important;';
            }
        }
        $customcss .= ' } ';
        $template->customcss = $customcss;
        $template->customclasses = $template->article_margin;
        $template->gridcount = $count;
        $template->containertype = $containertype;
        $customTemplate->setData($template->getData());
        $module->Template = $customTemplate;
    }
}
