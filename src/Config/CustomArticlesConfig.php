<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Config;

/**
 * Service to access the bundle configuration.
 */
class CustomArticlesConfig
{
    private array $config;
    private bool $enableBootstrap5;
    private bool $includeBootstrapCdn;
    private bool $enableCssGrid;
    private bool $enableFlexbox;
    private bool $enableDarkMode;
    private array $spacing;
    private array $responsive;

    public function __construct(
        array $config,
        bool $enableBootstrap5,
        bool $includeBootstrapCdn,
        bool $enableCssGrid,
        bool $enableFlexbox,
        bool $enableDarkMode,
        array $spacing,
        array $responsive
    ) {
        $this->config = $config;
        $this->enableBootstrap5 = $enableBootstrap5;
        $this->includeBootstrapCdn = $includeBootstrapCdn;
        $this->enableCssGrid = $enableCssGrid;
        $this->enableFlexbox = $enableFlexbox;
        $this->enableDarkMode = $enableDarkMode;
        $this->spacing = $spacing;
        $this->responsive = $responsive;
    }

    public function isBootstrap5Enabled(): bool
    {
        return $this->enableBootstrap5;
    }
    
    public function isBootstrapCdnEnabled(): bool
    {
        return $this->includeBootstrapCdn;
    }

    public function isCssGridEnabled(): bool
    {
        return $this->enableCssGrid;
    }

    public function isFlexboxEnabled(): bool
    {
        return $this->enableFlexbox;
    }

    public function isDarkModeEnabled(): bool
    {
        return $this->enableDarkMode;
    }

    public function getDefaultSpacing(): int
    {
        return $this->spacing['default_spacing'];
    }

    public function getCustomSpacings(): array
    {
        return $this->spacing['custom_spacings'];
    }

    public function isResponsiveImagesEnabled(): bool
    {
        return $this->responsive['enable_responsive_images'];
    }

    public function getBreakpoints(): array
    {
        return $this->responsive['breakpoints'];
    }

    public function getBreakpoint(string $name): ?int
    {
        return $this->responsive['breakpoints'][$name] ?? null;
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}
