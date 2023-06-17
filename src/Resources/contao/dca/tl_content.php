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
 * Add palettes to tl_content
 */

$GLOBALS['TL_DCA']['tl_content']['fields']['size_xs'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['size_xs'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'col_options'),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default '12'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['size_sm'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['size_sm'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'col_options'),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['size_md'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['size_md'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'col_options'),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['size_lg'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['size_lg'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'col_options'),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['size_xl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['size_xl'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'col_options'),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['size_xxl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['size_xxl'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'col_options'),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['order_xs'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_xs'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'order_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 11, 'tl_class' => 'w16'],
    'sql' => "varchar(11) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['order_sm'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_sm'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'order_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 11, 'tl_class' => 'w16'],
    'sql' => "varchar(11) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['order_md'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_md'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'order_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 11, 'tl_class' => 'w16'],
    'sql' => "varchar(11) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['order_lg'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_lg'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'order_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 11, 'tl_class' => 'w16'],
    'sql' => "varchar(11) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['order_xl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_xl'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'order_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 11, 'tl_class' => 'w16'],
    'sql' => "varchar(11) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['order_xxl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_xxl'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'order_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 11, 'tl_class' => 'w16'],
    'sql' => "varchar(11) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['offset_xs'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_xs'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'offset_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['offset_sm'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_sm'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'offset_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['offset_md'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_md'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'offset_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['offset_lg'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_lg'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'offset_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['offset_xl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_xl'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'offset_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['offset_xxl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_xxl'],
    'inputType' => 'select',
    'exclude' => true,
    'options_callback' => array('tl_custom_content', 'offset_options'),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w16'],
    'sql' => "varchar(2) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['content_visible'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['content_visible'],
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
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['content_visible'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w50', 'multiple' => true, 'chosen' => true],
    'sql' => "varchar(500) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['content_hidden'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['content_hidden'],
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
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['content_hidden'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w50', 'multiple' => true, 'chosen' => true],
    'sql' => "varchar(500) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['col_padding'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['col_padding'],
    'inputType' => 'select',
    'exclude' => true,
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
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['col_padding'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w25', 'multiple' => true, 'chosen' => true],
    'sql' => 'varchar(32) default NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['col_margin'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['col_margin'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'mt-0',
        'mb-0',
        'ms-0',
        'me-0',
        'mx-0',
        'my-0',
        'm-0',
        'mt-auto',
        'mb-auto',
        'ms-auto',
        'me-auto',
        'mx-auto',
        'my-auto',
        'm-auto',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['col_margin'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w25', 'multiple' => true, 'chosen' => true],
    'sql' => 'varchar(32) default NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['col_align'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['col_align'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'float-left',
        'mx-auto',
        'float-right',
        'float-none',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['col_align'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w25'],
    'sql' => 'varchar(32) default NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['col_valign'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['col_valign'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'align-self-start',
        'align-self-center',
        'align-self-end',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['col_valign'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w25'],
    'sql' => 'varchar(32) default NULL',
];

// Anpassung der Bild Palette
$GLOBALS['TL_DCA']['tl_content']['palettes']['image'] = str_replace(
    'caption;',
    'caption,lightbox;',
    $GLOBALS['TL_DCA']['tl_content']['palettes']['image']
);

// Hinzufügen der Feld-Konfiguration
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['lightbox'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => ['tl_class' => 'w50'],
    'sql' => "varchar(25) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['palettes']['newRow'] = '{type_legend},type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

class tl_custom_content extends Backend {
    public function col_options(){
        $range = array();
        foreach(range(1, 12) as $number) {
            $range[$number] = "col-".$number;
        }
        return $range;
    }
    public function offset_options(){
        $range = array();
        foreach(range(1, 12) as $number) {
            $range[$number] = "offset-".$number;
        }
        return $range;
    }
    public function order_options(){
        $range = array();
        $range['first'] = "order-first";
        foreach(range(1, 5) as $number) {
            $range[$number] = "order-".$number;
        }
        $range['last'] = "order-last";
        return $range;
    }
}
