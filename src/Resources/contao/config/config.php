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

if (TL_MODE == 'BE') {
	$GLOBALS['TL_CSS'][] = '/bundles/contaocustomarticles/assets/extend-backend.css';
}

/**
* Hooks
*/
if (TL_MODE == 'BE') {
	$GLOBALS['TL_HOOKS']['loadDataContainer'][]		 = array('Rwd\ContaoCustomArticlesBundle\Hooks\ArticleHook', 'appendGridComponentsCallback');
}

if(TL_MODE == 'FE'){
	$GLOBALS['TL_HOOKS']['compileArticle'][]		 = array('Rwd\ContaoCustomArticlesBundle\Hooks\ArticleHook', 'insertCustomTemplate');
	$GLOBALS['TL_HOOKS']['parseTemplate'][]	     = array('Rwd\ContaoCustomArticlesBundle\Hooks\TemplateHook', 'insertCustomGrid');
}

/**
 * Content elements
 */
array_insert($GLOBALS['TL_CTE']['style'], sizeof($GLOBALS['TL_CTE']['slider']), array(
	'newRow'     => 'Rwd\ContaoCustomArticlesBundle\Elements\NewRow'
));

/**
 * Wrapper elements
 */
array_insert($GLOBALS['TL_WRAPPERS']['separator'], sizeof($GLOBALS['TL_WRAPPERS']['separator']), array(
	'NewRow'
));
