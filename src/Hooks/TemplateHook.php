<?php

/**
* Contao Open Source CMS
*
* Copyright (C) 2005-2013 Leo Feyer
*
* @package   customarticle
* @author    Christian Romeni  <christian@romeni.eu>
* @link      https://romeni.eu
* @license   GNU
* @copyright Romeni WebDesign
*/

namespace Rwd\ContaoCustomArticlesBundle\Hooks;

class TemplateHook {
	/**
	* [insertCustomGrid description]
	*/
	public function insertCustomGrid($objTemplate)
	{
		// if($objTemplate->getName() == 'news_full'){
		// 	dump($objTemplate);
		// 	die();
		// }
		if ($objTemplate->getName() != ''
		 && $objTemplate->getName() != 'mod_html'
		 && $objTemplate->getName() != 'ce_newRow'
		 && $objTemplate->getName() != 'mod_newsreader'
	 	 && $objTemplate->getName() != 'news_full'){

			$classes = '';

			$arrClasses = [
				'grid_xs'   => 'col-',
				'grid_sm'   => 'col-sm-',
				'grid_md'   => 'col-md-',
				'grid_lg'   => 'col-lg-',
				'grid_xl'   => 'col-xl-',
				'offset_xs' => 'offset-',
				'offset_sm' => 'offset-sm-',
				'offset_md' => 'offset-md-',
				'offset_lg' => 'offset-lg-',
				'offset_xl' => 'offset-xl-',
				'order_xs'  => 'order-',
				'order_sm'  => 'order-sm-',
				'order_md'  => 'order-md-',
				'order_lg'  => 'order-lg-',
				'order_xl'  => 'order-xl-',
				'push_xs'   => 'col-push-',
				'push_sm'   => 'col-sm-push-',
				'push_md'   => 'col-md-push-',
				'push_lg'   => 'col-lg-push-'
			];

			foreach ($arrClasses as $key => $classPart) {
				if($objTemplate->$key != '' && $objTemplate->$key != -1){
					$classes .= ' '.$classPart.$objTemplate->$key;
				}
			}

			if($objTemplate->grid_visible != ''){
				$grid_visible = @unserialize($objTemplate->grid_visible);
				if ($grid_visible === 'b:0;' || $grid_visible !== false) {
					foreach (\Contao\StringUtil::deserialize($objTemplate->grid_visible) as $key => $value) {
						$classes .= ' ' . $value;
					}
				} else {
					$classes .= ' ' . $objTemplate->grid_visible;
				}
			}
			if($objTemplate->grid_hidden != ''){
				$grid_hidden = @unserialize($objTemplate->grid_hidden);
				if ($grid_hidden === 'b:0;' || $grid_hidden !== false) {
					foreach (\Contao\StringUtil::deserialize($objTemplate->grid_hidden) as $key => $value) {
						$classes .= ' ' . $value;
					}
				} else {
					$classes .= ' ' . $objTemplate->grid_hidden;
				}
			}

			if($objTemplate->col_padding || $objTemplate->col_padding != ''){
				$classes .= ' ' . $objTemplate->col_padding;
			}

			if($objTemplate->col_margin || $objTemplate->col_margin != ''){
				$classes .= ' ' . $objTemplate->col_margin;
			}

			if($objTemplate->col_align || $objTemplate->col_align != ''){
				$classes .= ' ' . $objTemplate->col_align;
			}

			if($objTemplate->col_valign || $objTemplate->col_valign != ''){
				$classes .= ' ' . $objTemplate->col_valign;
			}

			if($classes != ''){
				$objTemplate->class .= $classes;
			}
		}
	}
}
