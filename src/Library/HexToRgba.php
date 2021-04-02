<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Library;

class HexToRgba
{
    public function convertColors(string $color, ?float $opacity = null): string
    {
        $default = 'rgba(0,0,0,0)';

        if (empty($color)) {
            return $default;
        }

        if ('#' === $color[0]) {
            $color = substr($color, 1);
        }

        if (6 === \strlen($color)) {
            $hex = [$color[0].$color[1], $color[2].$color[3], $color[4].$color[5]];
        } elseif (3 === \strlen($color)) {
            $hex = [$color[0].$color[0], $color[1].$color[1], $color[2].$color[2]];
        } else {
            return $default;
        }
        $rgb = array_map('hexdec', $hex);

        if ($opacity) {
            $opacity /= 100;

            if (abs($opacity) > 1) {
                $opacity = 1.0;
            }
            $output = 'rgba('.implode(',', $rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(',', $rgb).')';
        }

        return $output;
    }
}
