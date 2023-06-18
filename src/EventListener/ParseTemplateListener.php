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

/**
 * @Hook("parseTemplate")
 */
class ParseTemplateListener
{
    public function __invoke(Template $template): void
    {
        $excludedTemplates = [
            '',
            'mod_html',
            'ce_newRow',
            'mod_newsreader',
            'news_full'
        ];
        $templateName = $template->getName();

        if (!in_array($templateName, $excludedTemplates, true)) {

            $classes = [];

            $arrClasses = [
                'size_xs' => 'col-',
                'size_sm' => 'col-sm-',
                'size_md' => 'col-md-',
                'size_lg' => 'col-lg-',
                'size_xl' => 'col-xl-',
                'size_xxl' => 'col-xxl-',
                'offset_xs' => 'offset-',
                'offset_sm' => 'offset-sm-',
                'offset_md' => 'offset-md-',
                'offset_lg' => 'offset-lg-',
                'offset_xl' => 'offset-xl-',
                'offset_xxl' => 'offset-xxl-',
                'order_xs' => 'order-',
                'order_sm' => 'order-sm-',
                'order_md' => 'order-md-',
                'order_lg' => 'order-lg-',
                'order_xl' => 'order-xl-',
                'order_xxl' => 'order-xxl-',
            ];

            foreach ($arrClasses as $classKey => $classPart) {
                $value = $template->{$classKey} ?? null;

                if ($value) {
                    $classes[] = $classPart . $value;
                }
            }

            if (!empty($template->content_visible)) {
                $contentVisible = StringUtil::deserialize($template->content_visible, 'array', 'contao.input');
                $classes = [...$classes, ...$contentVisible];
            }

            if (!empty($template->content_hidden)) {
                $contentHidden = StringUtil::deserialize($template->content_hidden, 'array', 'contao.input');
                $classes = [...$classes, ...$contentHidden];
            }

            if (!empty($template->col_padding)) {
                $colPadding = StringUtil::deserialize($template->col_padding, 'array', 'contao.input');
                $classes = [...$classes, ...$colPadding];
            }

            if (!empty($template->col_margin)) {
                $colMargin = StringUtil::deserialize($template->col_margin, 'array', 'contao.input');
                $classes = [...$classes, ...$colMargin];
            }

            if ($template->col_align) {
                $classes[] = $template->col_align;
            }

            if ($template->col_valign) {
                $classes[] = $template->col_valign;
            }

            if (!empty($classes)) {
                $template->class .= ' ' . implode(' ', $classes);
            }
        }
    }
}

