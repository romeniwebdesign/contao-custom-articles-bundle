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
Contao\ArrayUtil::arrayInsert($GLOBALS['TL_CTE']['style'], isset($GLOBALS['TL_CTE']['style']) && is_array($GLOBALS['TL_CTE']['style']) ? count($GLOBALS['TL_CTE']['style']) : 0, [
    'newRow' => NewRow::class,
]);

/*
 * Wrapper elements
 */
Contao\ArrayUtil::arrayInsert($GLOBALS['TL_WRAPPERS']['separator'], isset($GLOBALS['TL_WRAPPERS']['separator']) && is_array($GLOBALS['TL_WRAPPERS']['separator']) ? count($GLOBALS['TL_WRAPPERS']['separator']) : 0, [
    'NewRow',
]);
