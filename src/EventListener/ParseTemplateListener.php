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
        $templateName = $template->getName();

        if (
            '' !== $templateName
         && 'mod_html' !== $templateName
         && 'ce_newRow' !== $templateName
         && 'mod_newsreader' !== $templateName
         && 'news_full' !== $templateName
        ) {
            $classes = '';

            $arrClasses = [
                'size_xs' => 'col-',
                'size_sm' => 'col-sm-',
                'size_md' => 'col-md-',
                'size_lg' => 'col-lg-',
                'size_xl' => 'col-xl-',
                'offset_xs' => 'offset-',
                'offset_sm' => 'offset-sm-',
                'offset_md' => 'offset-md-',
                'offset_lg' => 'offset-lg-',
                'offset_xl' => 'offset-xl-',
                'order_xs' => 'order-',
                'order_sm' => 'order-sm-',
                'order_md' => 'order-md-',
                'order_lg' => 'order-lg-',
                'order_xl' => 'order-xl-',
                'push_xs' => 'col-push-',
                'push_sm' => 'col-sm-push-',
                'push_md' => 'col-md-push-',
                'push_lg' => 'col-lg-push-',
            ];

            foreach ($arrClasses as $key => $classPart) {
                if ($template->$key && $template->$key !== '') {
                    $classes .= ' '.$classPart.$template->$key;
                }
            }

            if ('' !== $template->content_visible) {
                $content_visible = @unserialize((string) $template->content_visible);

                if ('b:0;' === $content_visible || false !== $content_visible) {
                    foreach (StringUtil::deserialize($template->content_visible) as $value) {
                        $classes .= ' '.$value;
                    }
                } else {
                    $classes .= ' '.$template->content_visible;
                }
            }

            if ('' !== $template->content_hidden) {
                $content_hidden = @unserialize((string) $template->content_hidden);

                if ('b:0;' === $content_hidden || false !== $content_hidden) {
                    foreach (StringUtil::deserialize($template->content_hidden) as $value) {
                        $classes .= ' '.$value;
                    }
                } else {
                    $classes .= ' '.$template->content_hidden;
                }
            }

            if ($template->col_padding || '' !== $template->col_padding) {
                $col_padding = @unserialize((string) $template->col_padding);
                if ('b:0;' === $col_padding || false !== $col_padding) {
                    foreach (StringUtil::deserialize($template->col_padding) as $value) {
                        $classes .= ' '.$value;
                    }
                } else {
                    $classes .= ' '.$template->col_padding;
                }
            }

            if ($template->col_margin || '' !== $template->col_margin) {
                $classes .= ' '.$template->col_margin;
            }

            if ($template->col_align || '' !== $template->col_align) {
                $classes .= ' '.$template->col_align;
            }

            if ($template->col_valign || '' !== $template->col_valign) {
                $classes .= ' '.$template->col_valign;
            }

            if ('' !== $classes) {
                $template->class .= $classes;
            }
        }
    }
}
