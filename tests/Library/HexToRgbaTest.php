<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Tests\Library;

use PHPUnit\Framework\TestCase;
use Rwd\ContaoCustomArticlesBundle\Library\HexToRgba;

class HexToRgbaTest extends TestCase
{
    private HexToRgba $hexToRgba;

    protected function setUp(): void
    {
        $this->hexToRgba = new HexToRgba();
    }

    /**
     * @dataProvider colorProvider
     */
    public function testConvertColors(string $hex, ?float $opacity, string $expected): void
    {
        $result = $this->hexToRgba->convertColors($hex, $opacity);
        $this->assertSame($expected, $result);
    }

    public function colorProvider(): array
    {
        return [
            'hex with hash' => ['#ff0000', null, 'rgb(255,0,0)'],
            'hex without hash' => ['ff0000', null, 'rgb(255,0,0)'],
            'hex with opacity' => ['#ff0000', 50.0, 'rgba(255,0,0,0.5)'],
            'short hex' => ['#f00', null, 'rgb(255,0,0)'],
            'short hex with opacity' => ['#f00', 25.0, 'rgba(255,0,0,0.25)'],
            'empty color' => ['', null, 'rgba(0,0,0,0)'],
            'invalid color' => ['xyz', null, 'rgba(0,0,0,0)'],
            'opacity over 100' => ['#ff0000', 150.0, 'rgba(255,0,0,1)'],
        ];
    }
}
