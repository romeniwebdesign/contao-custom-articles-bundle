<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

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
