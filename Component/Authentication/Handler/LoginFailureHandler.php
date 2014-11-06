<?php

namespace  Rz\UserSecurityBundle\Component\Authentication\Handler;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use CCDNUser\SecurityBundle\Component\Authentication\Tracker\LoginFailureTracker;
use CCDNUser\SecurityBundle\Component\Authentication\Handler\LoginFailureHandler as BaseLoginFailureHandler;

class LoginFailureHandler extends BaseLoginFailureHandler
{

}
