<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

use Rwd\ContaoCustomArticlesBundle\Elements\NewRow;

/*
 * Content elements
 */
array_push($GLOBALS['TL_CTE']['style'], count($GLOBALS['TL_CTE']['slider']), [
    'newRow' => NewRow::class,
]);

/*
 * Wrapper elements
 */
array_push($GLOBALS['TL_WRAPPERS']['separator'], count($GLOBALS['TL_WRAPPERS']['separator']), [
    'NewRow',
]);
