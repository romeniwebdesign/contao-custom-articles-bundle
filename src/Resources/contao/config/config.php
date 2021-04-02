<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

use Rwd\ContaoCustomArticlesBundle\Hooks\ArticleHook;
use Rwd\ContaoCustomArticlesBundle\Hooks\TemplateHook;

if (TL_MODE === 'BE') {
    $GLOBALS['TL_CSS'][] = '/bundles/contaocustomarticles/assets/extend-backend.css';
}

/*
 * Hooks
 */
if (TL_MODE === 'BE') {
    $GLOBALS['TL_HOOKS']['loadDataContainer'][] = [ArticleHook::class, 'appendGridComponentsCallback'];
}

if (TL_MODE === 'FE') {
    $GLOBALS['TL_HOOKS']['compileArticle'][] = [ArticleHook::class, 'insertCustomTemplate'];
    $GLOBALS['TL_HOOKS']['parseTemplate'][] = [TemplateHook::class, 'insertCustomGrid'];
}

/*
 * Content elements
 */
array_insert($GLOBALS['TL_CTE']['style'], count($GLOBALS['TL_CTE']['slider']), [
    'newRow' => 'Rwd\ContaoCustomArticlesBundle\Elements\NewRow',
]);

/*
 * Wrapper elements
 */
array_insert($GLOBALS['TL_WRAPPERS']['separator'], count($GLOBALS['TL_WRAPPERS']['separator']), [
    'NewRow',
]);
