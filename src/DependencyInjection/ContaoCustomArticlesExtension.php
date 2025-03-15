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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContaoCustomArticlesExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        // Store the configuration in the container for later use
        $container->setParameter('contao_custom_articles.config', $config);
        $container->setParameter('contao_custom_articles.enable_bootstrap5', $config['enable_bootstrap5']);
        $container->setParameter('contao_custom_articles.enable_css_grid', $config['enable_css_grid']);
        $container->setParameter('contao_custom_articles.enable_flexbox', $config['enable_flexbox']);
        $container->setParameter('contao_custom_articles.enable_dark_mode', $config['enable_dark_mode']);
        $container->setParameter('contao_custom_articles.spacing', $config['spacing']);
        $container->setParameter('contao_custom_articles.responsive', $config['responsive']);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.yaml');
        
        // Load additional services based on configuration
        if ($config['enable_bootstrap5']) {
            if (file_exists(__DIR__.'/../Resources/config/bootstrap5.yaml')) {
                $loader->load('bootstrap5.yaml');
            }
        }
        
        if ($config['enable_css_grid']) {
            if (file_exists(__DIR__.'/../Resources/config/css_grid.yaml')) {
                $loader->load('css_grid.yaml');
            }
        }
    }
}
