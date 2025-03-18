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

use Contao\CoreBundle\Routing\ScopeMatcher;
use Rwd\ContaoCustomArticlesBundle\Config\CustomArticlesConfig;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class BootstrapSubscriber implements EventSubscriberInterface
{
    // Local paths to Bootstrap files
    private const BOOTSTRAP_CSS_LOCAL = 'bundles/contaocustomarticles/assets/bootstrap/bootstrap.min.css';
    private const BOOTSTRAP_JS_LOCAL = 'bundles/contaocustomarticles/assets/bootstrap/bootstrap.bundle.min.js';

    public function __construct(
        private readonly ScopeMatcher $scopeMatcher,
        private readonly CustomArticlesConfig $config
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::REQUEST => 'onKernelRequest'];
    }

    public function onKernelRequest(RequestEvent $e): void
    {
        $request = $e->getRequest();

        // Only add Bootstrap in frontend requests and if Bootstrap 5 is enabled
        if (!$this->scopeMatcher->isBackendRequest($request) && 
            $this->config->isBootstrap5Enabled()) {
            
            // Add Bootstrap CSS from local file
            $GLOBALS['TL_CSS'][] = self::BOOTSTRAP_CSS_LOCAL . '|static';
            
            // Add Bootstrap JS from local file
            $GLOBALS['TL_JAVASCRIPT'][] = self::BOOTSTRAP_JS_LOCAL . '|static';
        }
    }
}
