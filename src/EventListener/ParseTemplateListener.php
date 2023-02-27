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
                'grid_xs' => 'col-',
                'grid_sm' => 'col-sm-',
                'grid_md' => 'col-md-',
                'grid_lg' => 'col-lg-',
                'grid_xl' => 'col-xl-',
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
                if ($template->$key && $template->$key !== '-1') {
                    $classes .= ' '.$classPart.$template->$key;
                }
            }

            if ('' !== $template->grid_visible) {
                $grid_visible = @unserialize((string) $template->grid_visible);

                if ('b:0;' === $grid_visible || false !== $grid_visible) {
                    foreach (StringUtil::deserialize($template->grid_visible) as $value) {
                        $classes .= ' '.$value;
                    }
                } else {
                    $classes .= ' '.$template->grid_visible;
                }
            }

            if ('' !== $template->grid_hidden) {
                $grid_hidden = @unserialize((string) $template->grid_hidden);

                if ('b:0;' === $grid_hidden || false !== $grid_hidden) {
                    foreach (StringUtil::deserialize($template->grid_hidden) as $value) {
                        $classes .= ' '.$value;
                    }
                } else {
                    $classes .= ' '.$template->grid_hidden;
                }
            }

            if ($template->col_padding || '' !== $template->col_padding) {
                $classes .= ' '.$template->col_padding;
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
