<?php

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Tests;

use Rwd\ContaoCustomArticlesBundle\ContaoCustomArticlesBundle;
use PHPUnit\Framework\TestCase;

class ContaoCustomArticlesBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new ContaoCustomArticlesBundle();

        $this->assertInstanceOf('Rwd\ContaoCustomArticlesBundle\ContaoCustomArticlesBundle', $bundle);
    }
}
