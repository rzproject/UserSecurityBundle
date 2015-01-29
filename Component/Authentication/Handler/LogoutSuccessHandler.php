<?php

namespace Rz\UserSecurityBundle\Component\Authentication\Handler;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CCDNUser\SecurityBundle\Component\Authentication\Handler\LogoutSuccessHandler as BaseLogoutSuccessHandler;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\PageManagerInterface;
use Symfony\Cmf\Component\Routing\ChainedRouterInterface;

class LogoutSuccessHandler extends BaseLogoutSuccessHandler
{


    /**
     *
     * @access public
     * @param  \Symfony\Component\HttpFoundation\Request                                                     $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onLogoutSuccess(Request $request)
    {

        if ($this->routeReferer['enabled']) {
            $session = $request->getSession();

            if ($session->has('referer') ) {
                if ($session->get('referer') !== null && $session->get('referer') !== '') {
                    if(stristr($session->get('referer'), '/js/routing')) {
                        $response = new RedirectResponse($this->getRedirectUrl($request));
                    } else {
                        $response = new RedirectResponse($session->get('referer'));
                    }
                } else {

                    $response = new RedirectResponse($this->getRedirectUrl($request));
                }
            } else {
                // if no referer then go to homepage
                $response = new RedirectResponse($this->getRedirectUrl($request));
            }

            if ($request->isXmlHttpRequest() || $request->request->get('_format') === 'json') {
                $response = new Response(json_encode(array('status' => 'success')));
                $response->headers->set('Content-Type', 'application/json');
            }
        } else {
            if ($request->isXmlHttpRequest() || $request->request->get('_format') === 'json') {
                $response = new Response(
                    json_encode(
                        array(
                            'status' => 'failed',
                            'errors' => array($exception->getMessage())
                        )
                    )
                );

                $response->headers->set('Content-Type', 'application/json');
            } else {
                $response = new RedirectResponse(
                    $this->router->generate(
                        $this->routeLogin['name'],
                        $this->routeLogin['params']
                    )
                );
            }
        }

        return $response;
    }

    protected function getRedirectUrl(Request $request, $url = null) {
        return $request->getBaseUrl() . $url?:'/';
    }
}
