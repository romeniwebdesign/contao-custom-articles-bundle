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
    'options' => $GLOBALS['TL_CSS_UNITS'],
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
    'options' => $GLOBALS['TL_CSS_UNITS'],
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
    'options' => $GLOBALS['TL_CSS_UNITS'],
    'eval' => ['includeBlankOption' => true, 'rgxp' => 'digit_auto_inherit', 'maxlength' => 20, 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_article']['fields']['inner_article_minheight'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['inner_article_minheight'],
    'inputType' => 'inputUnit',
    'exclude' => true,
    'options' => $GLOBALS['TL_CSS_UNITS'],
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
        // 'top_bottom_spaceing' => 'Abstand oben und unten',
        'no_spaceing' => 'Kein Abstand oben und unten',
        'top_spaceing' => 'Abstand oben',
        'bottom_spaceing' => 'Abstand unten',
        'top_bottom_space' => 'Abstand oben und unten',
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
        'visible-xs',
        'visible-sm',
        'visible-md',
        'visible-lg',
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
        'hidden-xs',
        'hidden-sm',
        'hidden-md',
        'hidden-lg',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_article']['article_hidden'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w50', 'multiple' => true, 'chosen' => true],
    'sql' => "varchar(500) NOT NULL default ''",
];
