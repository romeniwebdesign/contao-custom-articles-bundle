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

$GLOBALS['TL_DCA']['tl_content']['fields']['grid_xs'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['grid_xs'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(1, 12),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '12'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['grid_sm'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['grid_sm'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(1, 12),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_md'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['grid_md'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(1, 12),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_lg'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['grid_lg'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(1, 12),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_xl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['grid_xl'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(1, 12),
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['order_xs'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_xs'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['order_sm'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_sm'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['order_md'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_md'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['order_lg'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_lg'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['order_xl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['order_xl'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['order'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['offset_xs'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_xs'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['offset_sm'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_sm'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['offset_md'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_md'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['offset_lg'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_lg'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];
$GLOBALS['TL_DCA']['tl_content']['fields']['offset_xl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['offset_xl'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => range(-1, 12),
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['offset'],
    'default' => -1,
    'eval' => ['includeBlankOption' => false, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w20'],
    'sql' => "varchar(2) NOT NULL default '-1'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['grid_visible'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['grid_visible'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'd-block d-sm-none',
        'd-none d-sm-block d-md-none',
        'd-none d-md-block d-lg-none',
        'd-none d-lg-block d-xl-none',
        'd-none d-xl-block',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['grid_visible'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w50', 'multiple' => true, 'chosen' => true],
    'sql' => "varchar(500) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['grid_hidden'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['grid_hidden'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'd-none d-sm-block',
        'd-block d-sm-none d-md-block',
        'd-block d-md-none d-lg-block',
        'd-block d-lg-none d-xl-block',
        'd-block d-xl-none',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['grid_hidden'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w50', 'multiple' => true, 'chosen' => true],
    'sql' => "varchar(500) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['col_padding'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['col_padding'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'pl-0',
        'pr-0',
        'px-0',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['col_padding'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w25 m12'],
    'sql' => 'varchar(32) default NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['col_margin'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['col_margin'],
    'inputType' => 'select',
    'exclude' => true,
    'options' => [
        'mt-0',
        'mb-0',
        'my-0',
        'ml-auto',
        'mr-auto',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['col_margin'],
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 255, 'tl_class' => 'w25 m12'],
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
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w25 m12'],
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
    'eval' => ['includeBlankOption' => true, 'mandatory' => false, 'maxlength' => 500, 'tl_class' => 'w25 m12'],
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

class tl_content_grid extends tl_content
{
    /**
     * Onload callback for tl_content
     *
     * Add language field to all content palettes
     *
     * @param DataContainer $dc
     */
    public function appendGridComponents(DataContainer $dc = null)
    {
        $dc->loadDataContainer('tl_page');
        $dc->loadDataContainer('tl_content');

        // add grid to all palettes
        foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $value) {
            // if element is '__selector__' OR 'default'
            if ($key == '__selector__' || $key == 'default' || $key == 'newRow' || strpos($value, ',grid(?=\{|,|;|$)') !== false) {
                continue;
            }

            $GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = $value . ';{grid_legend:hide},grid_xs,grid_sm,grid_md,grid_lg,grid_xl,grid_visible,grid_hidden,col_padding,col_margin,col_align,col_valign;{grid_order_legend:hide},order_xs,order_sm,order_md,order_lg,order_xl,push_xs,push_sm,push_md,push_lg,offset_xs,offset_sm,offset_md,offset_lg,offset_xl';
        }
    }
}
