<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('contao_custom_articles');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('enable_bootstrap5')
                    ->defaultTrue()
                    ->info('Enable Bootstrap 5 support')
                ->end()
                ->booleanNode('include_bootstrap_cdn')
                    ->defaultTrue()
                    ->info('Include Bootstrap 5 CSS and JS from CDN')
                ->end()
                ->booleanNode('enable_css_grid')
                    ->defaultTrue()
                    ->info('Enable CSS Grid support')
                ->end()
                ->booleanNode('enable_flexbox')
                    ->defaultTrue()
                    ->info('Enable Flexbox utilities')
                ->end()
                ->booleanNode('enable_dark_mode')
                    ->defaultFalse()
                    ->info('Enable dark mode support')
                ->end()
                ->arrayNode('spacing')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('default_spacing')
                            ->defaultValue(100)
                            ->info('Default spacing in pixels')
                        ->end()
                        ->arrayNode('custom_spacings')
                            ->scalarPrototype()->end()
                            ->defaultValue([])
                            ->info('Custom spacing values')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('responsive')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enable_responsive_images')
                            ->defaultTrue()
                            ->info('Enable responsive images')
                        ->end()
                        ->arrayNode('breakpoints')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->integerNode('xs')->defaultValue(0)->end()
                                ->integerNode('sm')->defaultValue(576)->end()
                                ->integerNode('md')->defaultValue(768)->end()
                                ->integerNode('lg')->defaultValue(992)->end()
                                ->integerNode('xl')->defaultValue(1200)->end()
                                ->integerNode('xxl')->defaultValue(1400)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
