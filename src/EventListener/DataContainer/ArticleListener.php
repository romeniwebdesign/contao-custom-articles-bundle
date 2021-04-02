<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Contao\Image;
use Contao\Input;
use Contao\StringUtil;

class ArticleListener
{
    /**
     * @Callback(table="tl_article", target="fields.article_image.wizard")
     */
    public function generateFilePickerWidget(DataContainer $dc): string
    {
        $href = 'contao/file.php?do='.Input::get('do').'&amp;table='.$dc->table.'&amp;field='.$dc->field.'&amp;value='.$dc->value.'';
        $title = StringUtil::specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MSC']['filepicker']));
        $onClick = 'Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\''.StringUtil::specialchars($GLOBALS['TL_LANG']['MOD']['files'][0]).'\',\'url\':this.href,\'id\':\''.$dc->field.'\',\'tag\':\'ctrl_'.$dc->field.('editAll' === Input::get('act') ? '_'.$dc->id : '').'\',\'self\':this});return false';
        $image = Image::getHtml('pickfile.svg', $GLOBALS['TL_LANG']['MSC']['filepicker'], 'style="vertical-align:top;cursor:pointer"');

        return sprintf(' <a href="%s" title="%s" onclick="%s">%s</a>', $href, $title, $onClick, $image);
    }
}
