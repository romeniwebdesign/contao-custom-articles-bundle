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

class ArticleHook extends \System {
	/**
	* getArticle hook
	*
	* insert custom template when
	* getArticle hook is called
	*
	*/
	public function insertCustomTemplate($tpl, $data, $article)
	{
		global $objPage;
		$layoutID = $objPage->layout;
		$objLayout = \LayoutModel::findByID($layoutID);

		$template                = new \FrontendTemplate('mod_article_custom');
		$count                   = count($tpl->elements);

		$containertype           = 'container';

		$article_color           = \Contao\StringUtil::deserialize($tpl->article_color);
		$article_width           = \Contao\StringUtil::deserialize($tpl->article_width);
		$article_minheight       = \Contao\StringUtil::deserialize($tpl->article_minheight);
		$article_image           = $tpl->article_image;
		$article_image_position  = $tpl->article_image_position;
		$article_image_repeat    = $tpl->article_image_repeat;
		$article_image_cover     = $tpl->article_image_cover;
		$article_image_fixed     = $tpl->article_image_fixed;

		$inner_article_width     = \Contao\StringUtil::deserialize($tpl->inner_article_width);
		$inner_article_space     = $tpl->inner_article_space;
		$inner_article_overflow  = $tpl->inner_article_overflow;
		$inner_article_color     = \Contao\StringUtil::deserialize($tpl->inner_article_color);
		$inner_article_float     = $tpl->inner_article_float;
		$inner_article_minheight = \Contao\StringUtil::deserialize($tpl->inner_article_minheight);

		if($tpl->article_visible != ''){
			$tmpclasses = $article->cssID;
			$article_visible = @unserialize($tpl->article_visible);
			if ($article_visible === 'b:0;' || $article_visible !== false) {
				foreach (\Contao\StringUtil::deserialize($tpl->article_visible) as $key => $value) {
					$tmpclasses[1] .= ' ' . $value;
				}
			} else {
				$tmpclasses[1] .= ' ' . $tpl->article_visible;
			}
			$article->cssID = $tmpclasses;
		}
		if($tpl->article_hidden != ''){
			$tmpclasses = $article->cssID;
			$article_hidden = @unserialize($tpl->article_hidden);
			if ($article_hidden === 'b:0;' || $article_hidden !== false) {
				foreach (\Contao\StringUtil::deserialize($tpl->article_hidden) as $key => $value) {
					$tmpclasses[1] .= ' ' . $value;
				}
			} else {
				$tmpclasses[1] .= ' ' . $tpl->article_hidden;
			}
			$article->cssID = $tmpclasses;
		}

		$customcss =	".mod_article.section_$tpl->id { ";
			if(isset($article_width['value']) && $article_width['value'] != ''){
				if($article_width['value'] == 100  && preg_match("/%|vw/", $article_width['unit'])) {
					$containertype = 'container-fluid';
				}
				else {
					$containertype = 'container';
				}
				$customcss .= "width:" . $article_width['value'] . $article_width['unit'] . " !important;";
				$customcss .= "max-width:" . $article_width['value'] . $article_width['unit'] . " !important;";
			}
			if(isset($article_minheight['value']) && $article_minheight['value'] != ''){
				$customcss .= "min-height:" . $article_minheight['value'] . $article_minheight['unit'] . " !important;";
			}
			if(isset($article_color[0]) && $article_color[0] != ''){
				$customcss .= "background-color:" . $this->cHex2rgba($article_color[0],$article_color[1]) . " !important;";
			}
			if(isset($article_image) && $article_image != ''){
				$customcss .= "background-image:url('" . $article_image . "') !important;";
			}
			if(isset($article_image_repeat) && $article_image_repeat != ''){
				$customcss .= "background-repeat:" . $article_image_repeat . " !important;";
			}
			if(isset($article_image_position) && $article_image_position != ''){
				$customcss .= "background-position:" . $article_image_position . " !important;";
			}
			if($article_image_cover) {
				$customcss .= "
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=$img-uri, sizingMethod='scale');
					-ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=$img-uri, sizingMethod='scale') !important;";
				if($article_image_fixed){
					$customcss .= "background-attachment: fixed";
				}
				else {
					$customcss .= "background-attachment: initial";
				}
			}
			if(isset($inner_article_space) && $inner_article_space != ''){
				if($inner_article_space == 'no_spaceing'){
					$customcss .= "padding-bottom:0 !important;";
					$customcss .= "padding-top:0 !important;";
				}
				if($inner_article_space == 'top_spaceing'){
					$customcss .= "padding-top:100px !important;";
				}
				if($inner_article_space == 'bottom_spaceing'){
					$customcss .= "padding-bottom:100px !important;";
				}
				if($inner_article_space == 'top_bottom_space'){
					$customcss .= "padding-bottom:100px !important;";
					$customcss .= "padding-top:100px !important;";
				}
			}

		$customcss .= " } ";
		if(isset($article_minheight['value']) && $article_minheight['value'] != ''){
			$customcss .= ".mod_article.section_$tpl->id > * { min-height:inherit; }";
			$customcss .= ".mod_article.section_$tpl->id > * > * { min-height:inherit; }";
		}
		$customcss .=	".mod_article.section_$tpl->id .section_content { ";
			if(isset($inner_article_color[0]) && $inner_article_color[0] != ''){
				$customcss .= "background-color:" . $this->cHex2rgba($inner_article_color[0],$inner_article_color[1]) . " !important;";
			}
			if(isset($inner_article_width['value']) && $inner_article_width['value'] != ''){
				$customcss .= "width:" . $inner_article_width['value'] . $inner_article_width['unit'] . " !important;";
				$customcss .= "max-width:" . $inner_article_width['value'] . $inner_article_width['unit'] . " !important;";
			}
			if(isset($inner_article_minheight['value']) && $inner_article_minheight['value'] != ''){
				$customcss .= "min-height:" . $inner_article_minheight['value'] . $inner_article_minheight['unit'] . " !important; display:block;";
			}
		$customcss .= " } ";
		$customcss .=	".mod_article.section_$tpl->id .section_content > .row { ";
			if(isset($inner_article_overflow) && $inner_article_overflow != ''){
				if ($inner_article_overflow == 'overflow_hidden') {
					$customcss .= "overflow:hidden !important;";
				}
				if ($inner_article_overflow == 'overflow_visible') {
					$customcss .= "overflow:visible !important;";
				}
			}
		$customcss .= " } ";
		$tpl->customcss = $customcss;
		$tpl->customclasses = $tpl->article_margin;
		$tpl->gridcount = $count;
		$tpl->containertype = $containertype;
		$template->setData($tpl->getData());
		$article->Template = $template;
	}

	/**
	* loadDataContainer hook
	*
	* Add onload_callback definition when loadDataContainer hook is
	* called to define onload_callback as late as possible
	*
	* @param   String  $strName
	*/
	public function appendGridComponentsCallback($strName)
	{
		if ($strName == 'tl_content') {
			$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_grid', 'appendGridComponents');
		}
	}

	private function cHex2rgba($color, $opacity = false) {
		$default = 'rgb(0,0,0)';
		if(empty($color))
			return $default;
			if ($color[0] == '#' ) {
				$color = substr( $color, 1 );
			}
			if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
				return $default;
			}
			$rgb =  array_map('hexdec', $hex);
			if($opacity){
				$opacity = $opacity/100;
				if(abs($opacity) > 1)
					$opacity = 1.0;
					$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
				} else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
		return $output;
	}

}
