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
use Rwd\ContaoCustomArticlesBundle\Template\TemplateRegistry;

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
            return;
        }
        
        // Use template registry if available
        $templateRegistry = System::getContainer()->get(TemplateRegistry::class, System::getContainer()::NULL_ON_INVALID_REFERENCE);
        
        if ($templateRegistry !== null) {
            $this->Template = $templateRegistry->getTemplate($this->strTemplate);
            
            // Add accessibility attributes
            $this->Template->attributes = 'role="presentation"';
        }
    }
}
