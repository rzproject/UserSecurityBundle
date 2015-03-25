<?php

namespace  Rz\UserSecurityBundle\Component\Authentication\Handler;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use CCDNUser\SecurityBundle\Component\Authentication\Handler\LoginFailureHandler as BaseLoginFailureHandler;


class LoginFailureHandler extends BaseLoginFailureHandler
{

    /**
     *
     * @access public
     * @param  \Symfony\Component\HttpFoundation\Request                                                     $request
     * @param  \Symfony\Component\Security\Core\Exception\AuthenticationException                            $exception
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // Get the visitors IP address and attempted username.
        $ipAddress = $request->getClientIp();
        if ($request->request->has('_username')) {
            $username = $request->request->get('_username');
        } else {
            $username = '';
        }
        // Make a note of the failed login.
        $this->loginFailureTracker->addAttempt($ipAddress, $username);
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        // Send response back to browser depending on wether this is XML request or not.
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

        return $response;
    }

}
