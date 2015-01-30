<?php

namespace Rz\UserSecurityBundle\Component\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use CCDNUser\SecurityBundle\Component\Listener\RouteRefererListener as BaseRouteRefererListener;


class RouteRefererListener extends BaseRouteRefererListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        // Abort if we are dealing with some symfony2 internal requests.
        if ($event->getRequestType() !== \Symfony\Component\HttpKernel\HttpKernel::MASTER_REQUEST) {
            return;
        }

        // Get the route from the request object.
        $request = $event->getRequest();
        $route = $request->get('_route');

        if (in_array($route, $this->routeIgnoreList)) {
            return;
        }

        // Check for any internal routes.
        if ($route[0] == '_') {
            return;
        }
        // Get the session and assign it the url we are at presently.
        $session = $request->getSession();
        $session->set('referer', $request->getRequestUri());
    }
}
