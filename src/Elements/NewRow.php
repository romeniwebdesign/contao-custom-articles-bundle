<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Elements;

use Contao\BackendTemplate;
use Contao\ContentElement;

class NewRow extends ContentElement
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_newRow';

    /**
     * Generate the content element.
     */
    protected function compile(): void
    {
        if (TL_MODE === 'BE') {
            $this->strTemplate = 'be_wildcard';

            /** @var BackendTemplate|object $objTemplate */
            $objTemplate = new BackendTemplate($this->strTemplate);

            $this->Template = $objTemplate;
        }
    }
}
