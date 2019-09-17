<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Rwd\ContaoCustomArticlesBundle\Elements;

/**
 * Divider.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class NewRow extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_newRow';


    /**
     * Generate the content element
     */
    protected function compile()
    {
        if (TL_MODE == 'BE') {
            $this->strTemplate = 'be_wildcard';

            /** @var BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate($this->strTemplate);

            $this->Template = $objTemplate;
        }
    }
}
