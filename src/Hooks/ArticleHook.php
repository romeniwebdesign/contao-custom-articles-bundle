<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Hooks;

use Contao\FrontendTemplate;
use Contao\StringUtil;
use Contao\System;
use Rwd\ContaoCustomArticlesBundle\Library\HexToRgba;

class ArticleHook extends System
{
    /**
     * getArticle hook.
     *
     * insert custom template when
     * getArticle hook is called
     */
    public function insertCustomTemplate($tpl, $data, $article): void
    {
        /** @var HexToRgba $hextorgba */
        $hextorgba = System::getContainer()->get('rwd.contao_custom_articles_bundle.hex_to_rgba');

        $template = new FrontendTemplate('mod_article_custom');
        $count = \count($tpl->elements);

        $containertype = 'container';

        $article_color = StringUtil::deserialize($tpl->article_color);
        $article_width = StringUtil::deserialize($tpl->article_width);
        $article_minheight = StringUtil::deserialize($tpl->article_minheight);
        $article_image = $tpl->article_image;
        $article_image_position = $tpl->article_image_position;
        $article_image_repeat = $tpl->article_image_repeat;
        $article_image_cover = $tpl->article_image_cover;
        $article_image_fixed = $tpl->article_image_fixed;

        $inner_article_width = StringUtil::deserialize($tpl->inner_article_width);
        $inner_article_space = $tpl->inner_article_space;
        $inner_article_overflow = $tpl->inner_article_overflow;
        $inner_article_color = StringUtil::deserialize($tpl->inner_article_color);
        $inner_article_minheight = StringUtil::deserialize($tpl->inner_article_minheight);

        if ('' !== $tpl->article_visible) {
            $tmpclasses = $article->cssID;
            $article_visible = @unserialize($tpl->article_visible);

            if ('b:0;' === $article_visible || false !== $article_visible) {
                foreach (StringUtil::deserialize($tpl->article_visible) as $value) {
                    $tmpclasses[1] .= ' '.$value;
                }
            } else {
                $tmpclasses[1] .= ' '.$tpl->article_visible;
            }
            $article->cssID = $tmpclasses;
        }

        if ('' !== $tpl->article_hidden) {
            $tmpclasses = $article->cssID;
            $article_hidden = @unserialize($tpl->article_hidden);

            if ('b:0;' === $article_hidden || false !== $article_hidden) {
                foreach (StringUtil::deserialize($tpl->article_hidden) as $value) {
                    $tmpclasses[1] .= ' '.$value;
                }
            } else {
                $tmpclasses[1] .= ' '.$tpl->article_hidden;
            }
            $article->cssID = $tmpclasses;
        }

        $customcss = ".mod_article.section_$tpl->id { ";

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
            $customcss .= 'background-color:'.$hextorgba->convertColors($article_color[0], (float) $article_color[1]).' !important;';
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
                $customcss .= 'background-attachment: fixed';
            } else {
                $customcss .= 'background-attachment: initial';
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
            $customcss .= ".mod_article.section_$tpl->id > * { min-height:inherit; }";
            $customcss .= ".mod_article.section_$tpl->id > * > * { min-height:inherit; }";
        }
        $customcss .= ".mod_article.section_$tpl->id .section_content { ";

        if (isset($inner_article_color[0]) && '' !== $inner_article_color[0]) {
            $customcss .= 'background-color:'.$hextorgba->convertColors($inner_article_color[0], (float) $inner_article_color[1]).' !important;';
        }

        if (isset($inner_article_width['value']) && '' !== $inner_article_width['value']) {
            $customcss .= 'width:'.$inner_article_width['value'].$inner_article_width['unit'].' !important;';
            $customcss .= 'max-width:'.$inner_article_width['value'].$inner_article_width['unit'].' !important;';
        }

        if (isset($inner_article_minheight['value']) && '' !== $inner_article_minheight['value']) {
            $customcss .= 'min-height:'.$inner_article_minheight['value'].$inner_article_minheight['unit'].' !important; display:block;';
        }
        $customcss .= ' } ';
        $customcss .= ".mod_article.section_$tpl->id .section_content > .row { ";

        if (isset($inner_article_overflow) && '' !== $inner_article_overflow) {
            if ('overflow_hidden' === $inner_article_overflow) {
                $customcss .= 'overflow:hidden !important;';
            }

            if ('overflow_visible' === $inner_article_overflow) {
                $customcss .= 'overflow:visible !important;';
            }
        }
        $customcss .= ' } ';
        $tpl->customcss = $customcss;
        $tpl->customclasses = $tpl->article_margin;
        $tpl->gridcount = $count;
        $tpl->containertype = $containertype;
        $template->setData($tpl->getData());
        $article->Template = $template;
    }
}
