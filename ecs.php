<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $vendorDir = __DIR__.'/vendor';

    if (!is_dir($vendorDir)) {
        $vendorDir = __DIR__.'/../../vendor';
    }

    $containerConfigurator->import($vendorDir.'/contao/easy-coding-standard/config/default.php');

    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::EXCLUDE_PATHS, ['*/templates/*']);
    $parameters->set(Option::CACHE_DIRECTORY, sys_get_temp_dir().'/ecs_default_cache_custom_articles');

    $services = $containerConfigurator->services();
    $services
        ->set(HeaderCommentFixer::class)
        ->call('configure', [[
            'header' => "This file is part of Custom Article for Contao Open Source CMS.\n\n(c) Christian Romeni\n\n@license LGPL-3.0-or-later",
        ]])
    ;
};
