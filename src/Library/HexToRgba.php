<?php

declare(strict_types=1);

namespace Rwd\ContaoCustomArticlesBundle\Library;

class HexToRgba
{
	public function convertColors(string $color, $opacity = false): string
	{
		$default = 'rgba(0,0,0,0)';
		if (empty($color)) {
			return $default;
		}
		else {
			if ($color[0] == '#') {
				$color = substr($color, 1);
			}
			if (strlen($color) == 6) {
				$hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
			} elseif (strlen($color) == 3) {
				$hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
			} else {
				return $default;
			}
			$rgb =  array_map('hexdec', $hex);
			if($opacity){
				$opacity = $opacity/100;
				if(abs($opacity) > 1){
					$opacity = 1.0;
				}
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			}
			else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
			return $output;
		}
	}
}