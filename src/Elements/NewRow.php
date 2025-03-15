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
use Contao\System;

/**
 * Content element "new row" to create Bootstrap row breaks.
 */
class NewRow extends ContentElement
{
    protected $strTemplate = 'ce_newRow';

    protected function compile(): void
    {
        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? System::getContainer()->get('request_stack')->getMainRequest())) {
            $this->strTemplate = 'be_wildcard';
            $this->Template = new BackendTemplate($this->strTemplate);
        }
    }
}
