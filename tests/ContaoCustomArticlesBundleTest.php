<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Tests;

use PHPUnit\Framework\TestCase;
use Rwd\ContaoCustomArticlesBundle\ContaoCustomArticlesBundle;

class ContaoCustomArticlesBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new ContaoCustomArticlesBundle();

        $this->assertInstanceOf('Rwd\ContaoCustomArticlesBundle\ContaoCustomArticlesBundle', $bundle);
    }
}
