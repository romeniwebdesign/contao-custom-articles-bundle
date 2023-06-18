<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

use Contao\Config;

/*
 * Add palettes to tl_article
 */
$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = str_replace('cssID;', 'cssID;{Artikel},article_visible,article_hidden,article_width,article_minheight,article_color,article_image,article_image_repeat,article_image_position,article_image_cover,article_image_fixed;{Artikel Inhalt},inner_article_width,inner_article_minheight,inner_article_space,inner_article_overflow,inner_article_color;', $GLOBALS['TL_DCA']['tl_article']['palettes']['default']);

/*
 * Add fields to tl_article
 */
$GLOBALS['TL_DCA']['tl_article']['fields']['article_width'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_width'],
    'inputType' => 'inputUnit',
    'exclude' => true,
    'options' => array('px', '%', 'em', 'rem', 'vw', 'vh', 'pt'),
    'eval' => ['includeBlankOption' => true, 'rgxp' => 'digit_auto_inherit', 'maxlength' => 20, 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_color'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_color'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_image'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_image'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => ['filesOnly' => true, 'extensions' => Config::get('validImageTypes'), 'fieldType' => 'radio', 'tl_class' => 'w50 wizard'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_image_repeat'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_image_repeat'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => ['repeat', 'repeat-x', 'repeat-y', 'no-repeat'],
    'eval' => ['includeBlankOption' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_image_position'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_image_position'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => ['left top', 'left center', 'left bottom', 'center top', 'center center', 'center bottom', 'right top', 'right center', 'right bottom'],
    'eval' => ['includeBlankOption' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_image_cover'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_image_cover'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => ['tl_class' => 'w50 m12'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_image_fixed'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_image_fixed'],
    'inputType' => 'checkbox',
    'exclude' => true,
    'eval' => ['tl_class' => 'w50 m12'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_minheight'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_minheight'],
    'inputType' => 'inputUnit',
    'exclude' => true,
    'options' => array('px', '%', 'em', 'rem', 'vw', 'vh', 'pt'),
    'eval' => ['includeBlankOption' => true, 'rgxp' => 'digit_inherit', 'maxlength' => 20, 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_margin'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_margin'],
    'exclude' => true,
    'search' => false,
    'default' => '',
    'inputType' => 'select',
    'options' => [
        'top_bottom_margin' => 'Abstand oben und unten',
        'top_margin' => 'Abstand nur oben',
        'bottom_margin' => 'Abstand nur unten',
    ],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['inner_article_width'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['inner_article_width'],
    'inputType' => 'inputUnit',
    'exclude' => true,
    'options' => array('px', '%', 'em', 'rem', 'vw', 'vh', 'pt'),
    'eval' => ['includeBlankOption' => true, 'rgxp' => 'digit_auto_inherit', 'maxlength' => 20, 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['inner_article_minheight'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['inner_article_minheight'],
    'inputType' => 'inputUnit',
    'exclude' => true,
    'options' => array('px', '%', 'em', 'rem', 'vw', 'vh', 'pt'),
    'eval' => ['includeBlankOption' => true, 'rgxp' => 'digit_inherit', 'maxlength' => 20, 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['inner_article_color'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['inner_article_color'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['inner_article_space'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['inner_article_space'],
    'exclude' => true,
    'search' => false,
    'default' => '',
    'inputType' => 'select',
    'options' => [
        'pt-0',
        'pb-0',
        'ps-0',
        'pe-0',
        'px-0',
        'py-0',
        'p-0',
        'pt-auto',
        'pb-auto',
        'ps-auto',
        'pe-auto',
        'px-auto',
        'py-auto',
        'p-auto',
    ],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['inner_article_overflow'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['inner_article_overflow'],
    'exclude' => true,
    'search' => false,
    'default' => 'overflow_hidden',
    'inputType' => 'select',
    'options' => [
        'overflow_hidden' => 'Overflow verstecken',
        'overflow_visible' => 'Overflow anzeigen',
    ],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_visible'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_visible'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'd-block',
        'd-block d-sm-none',
        'd-none d-sm-block d-md-none',
        'd-none d-md-block d-lg-none',
        'd-none d-lg-block d-xl-none',
        'd-none d-xl-block d-xxl-none',
        'd-none d-xxl-block',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_article']['article_visible'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w50', 'multiple' => true, 'chosen' => true],
    'sql' => "varchar(500) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['article_hidden'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['article_hidden'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'd-none',
        'd-none d-sm-block',
        'd-sm-none d-md-block',
        'd-md-none d-lg-block',
        'd-lg-none d-xl-block',
        'd-xl-none d-xxl-block',
        '.d-xxl-none',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_article']['article_hidden'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w50', 'multiple' => true, 'chosen' => true],
    'sql' => "varchar(500) NOT NULL default ''",
];
