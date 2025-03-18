<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\Template;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\FrontendTemplate;
use Contao\Template;
use Rwd\ContaoCustomArticlesBundle\Config\CustomArticlesConfig;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

/**
 * Registry for templates, handling both PHP and Twig templates.
 */
class TemplateRegistry
{
    private ContaoFramework $framework;
    private Environment $twig;
    private RequestStack $requestStack;
    private CustomArticlesConfig $config;
    private array $twigTemplates = [
        'mod_article_custom' => '@RwdContaoCustomArticles/mod_article_custom.html.twig',
        'ce_newRow' => '@RwdContaoCustomArticles/ce_newRow.html.twig'
    ];

    public function __construct(
        ContaoFramework $framework,
        Environment $twig,
        RequestStack $requestStack,
        CustomArticlesConfig $config
    ) {
        $this->framework = $framework;
        $this->twig = $twig;
        $this->requestStack = $requestStack;
        $this->config = $config;
    }

    /**
     * Get a template instance (either PHP or Twig).
     */
    public function getTemplate(string $templateName): object
    {
        // Check if we should use Twig templates
        $request = $this->requestStack->getCurrentRequest();
        $useTwig = $request && $request->attributes->get('_format') === 'twig';

        // If Twig is requested and we have a Twig template for this name
        if ($useTwig && isset($this->twigTemplates[$templateName])) {
            return new TwigTemplateProxy(
                $this->twig,
                $this->twigTemplates[$templateName],
                $templateName
            );
        }

        // Otherwise use PHP template
        $this->framework->initialize();
        
        if ($templateName === 'mod_article_custom') {
            return new FrontendTemplate($templateName);
        }
        
        return new Template($templateName);
    }

    /**
     * Check if a Twig template exists for the given name.
     */
    public function hasTwigTemplate(string $templateName): bool
    {
        return isset($this->twigTemplates[$templateName]);
    }

    /**
     * Get the Twig template name for the given PHP template name.
     */
    public function getTwigTemplateName(string $phpTemplateName): ?string
    {
        return $this->twigTemplates[$phpTemplateName] ?? null;
    }
}
