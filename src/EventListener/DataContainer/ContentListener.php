<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;

class ContentListener
{
    /**
     * @Callback(table="tl_content", target="config.onload", priority=-999)
     */
    public function appendGridComponents(DataContainer $dc): void
    {
        $dc::loadDataContainer('tl_page');
        $dc::loadDataContainer('tl_content');

        // add grid to all palettes
        foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $value) {
            // if element is '__selector__' OR 'default'
            if ('__selector__' === $key || 'default' === $key || 'newRow' === $key || false !== strpos($value, ',grid(?=\{|,|;|$)')) {
                continue;
            }

            $GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = $value.';{element_width_legend},size_xs,size_sm,size_md,size_lg,size_xl,size_xxl;{element_visibility_legend},content_visible,content_hidden;{element_layout_legend},col_padding,col_margin,col_align,col_valign;{element_order_legend},order_xs,order_sm,order_md,order_lg,order_xl,order_xxl;{element_offset_legend},offset_xs,offset_sm,offset_md,offset_lg,offset_xl,offset_xxl';
        }
    }
}
