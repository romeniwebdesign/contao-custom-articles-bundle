<?php

declare(strict_types=1);

/*
 * This file is part of Custom Article for Contao Open Source CMS.
 *
 * (c) Christian Romeni
 *
 * @license LGPL-3.0-or-later
 */

namespace Rwd\ContaoCustomArticlesBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Loader\FilesystemLoader;

class TwigTemplateSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly FilesystemLoader $twigLoader,
        private readonly string $projectDir
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::REQUEST => 'onKernelRequest'];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        // Register our Twig namespace
        $paths = [
            // Check in vendor directory (standard installation)
            $this->projectDir . '/vendor/romeniwebdesign/contao-custom-articles-bundle/src/Resources/views',
            // Check in bundle directory (development installation)
            $this->projectDir . '/bundles/contaocustomarticles/src/Resources/views',
            // Check directly in the bundle's Resources/views directory
            __DIR__ . '/../Resources/views',
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                $this->twigLoader->addPath($path, 'RwdContaoCustomArticles');
                break; // Use the first path that exists
            }
        }
    }
}
