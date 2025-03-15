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

use Twig\Environment;

/**
 * Proxy class that mimics a Contao template but uses Twig under the hood.
 */
class TwigTemplateProxy
{
    private Environment $twig;
    private string $templateName;
    private string $originalName;
    private array $data = [];

    public function __construct(Environment $twig, string $templateName, string $originalName)
    {
        $this->twig = $twig;
        $this->templateName = $templateName;
        $this->originalName = $originalName;
    }

    /**
     * Get the template name.
     */
    public function getName(): string
    {
        return $this->originalName;
    }

    /**
     * Set template data.
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get template data.
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Magic getter for template variables.
     */
    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * Magic setter for template variables.
     */
    public function __set(string $name, $value): void
    {
        $this->data[$name] = $value;
    }

    /**
     * Magic isset for template variables.
     */
    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    /**
     * Render the template.
     */
    public function parse(): string
    {
        return $this->twig->render($this->templateName, $this->data);
    }

    /**
     * Output the template.
     */
    public function output(): void
    {
        echo $this->parse();
    }

    /**
     * Convert to string.
     */
    public function __toString(): string
    {
        return $this->parse();
    }
}
