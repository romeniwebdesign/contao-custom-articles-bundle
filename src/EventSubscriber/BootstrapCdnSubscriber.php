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

class BootstrapCdnSubscriber implements EventSubscriberInterface
{
    private const BOOTSTRAP_CSS_CDN = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css';
    private const BOOTSTRAP_JS_CDN = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js';

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

        // Only add Bootstrap in frontend requests and if Bootstrap 5 and CDN are enabled
        if (!$this->scopeMatcher->isBackendRequest($request) && 
            $this->config->isBootstrap5Enabled() && 
            $this->config->isBootstrapCdnEnabled()) {
            // Add Bootstrap CSS from CDN
            $GLOBALS['TL_CSS'][] = self::BOOTSTRAP_CSS_CDN . '|static|integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"';
            
            // Add Bootstrap JS from CDN
            $GLOBALS['TL_JAVASCRIPT'][] = self::BOOTSTRAP_JS_CDN . '|static|integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"';
        }
    }
}
