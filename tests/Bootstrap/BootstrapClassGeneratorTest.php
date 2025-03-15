<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Tests\Bootstrap;

use PHPUnit\Framework\TestCase;
use Rwd\ContaoCustomArticlesBundle\Bootstrap\BootstrapClassGenerator;
use Rwd\ContaoCustomArticlesBundle\Config\CustomArticlesConfig;

class BootstrapClassGeneratorTest extends TestCase
{
    private BootstrapClassGenerator $generator;
    private CustomArticlesConfig $config;

    protected function setUp(): void
    {
        $this->config = $this->createMock(CustomArticlesConfig::class);
        $this->generator = new BootstrapClassGenerator($this->config);
    }

    public function testGenerateColumnClasses(): void
    {
        $options = [
            'grid_xs' => '12',
            'grid_sm' => '6',
            'grid_md' => '4',
            'grid_lg' => '3',
            'grid_xl' => '2',
        ];

        $expected = 'col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2';
        $result = $this->generator->generateColumnClasses($options);

        $this->assertSame($expected, $result);
    }

    public function testGenerateVisibilityClasses(): void
    {
        $options = [
            'grid_visible' => ['visible-xs', 'visible-md'],
            'grid_hidden' => ['hidden-sm'],
        ];

        $expected = 'd-block d-sm-none d-none d-md-block d-lg-none d-block d-sm-none d-md-block';
        $result = $this->generator->generateVisibilityClasses($options);

        $this->assertSame($expected, $result);
    }

    public function testGenerateAlignmentClasses(): void
    {
        $options = [
            'col_align' => 'float-left',
            'col_valign' => 'align-self-center',
        ];

        $expected = 'float-start align-self-center';
        $result = $this->generator->generateAlignmentClasses($options);

        $this->assertSame($expected, $result);
    }

    public function testGenerateContainerClass(): void
    {
        // Test container-fluid
        $options1 = [
            'article_width' => [
                'value' => '100',
                'unit' => '%',
            ],
        ];

        $this->assertSame('container-fluid', $this->generator->generateContainerClass($options1));

        // Test container
        $options2 = [
            'article_width' => [
                'value' => '1200',
                'unit' => 'px',
            ],
        ];

        $this->assertSame('container', $this->generator->generateContainerClass($options2));
    }

    public function testGenerateDarkModeClass(): void
    {
        // Test dark mode enabled
        $this->config->method('isDarkModeEnabled')->willReturn(true);
        $this->assertSame('dark-mode', $this->generator->generateDarkModeClass());

        // Test dark mode disabled
        $this->config = $this->createMock(CustomArticlesConfig::class);
        $this->config->method('isDarkModeEnabled')->willReturn(false);
        $this->generator = new BootstrapClassGenerator($this->config);
        $this->assertSame('', $this->generator->generateDarkModeClass());
    }
}
