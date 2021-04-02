<?php

namespace Rwd\ContaoCustomArticlesBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Rwd\ContaoCustomArticlesBundle\ContaoCustomArticlesBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoCustomArticlesBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}