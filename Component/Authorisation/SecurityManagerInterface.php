<?php

namespace Rz\UserSecurityBundle\Component\Authorisation;

use Symfony\Component\HttpFoundation\RequestStack;
use Rz\UserSecurityBundle\Component\Authentication\Tracker\LoginFailureTracker;

interface SecurityManagerInterface
{
    const ACCESS_ALLOWED = 0;
    const ACCESS_DENIED_DEFER = 1;
    const ACCESS_DENIED_BLOCK = 2;

    /**
     * Constructor
     *
     * @access public
     * @param \Symfony\Component\HttpFoundation\RequestStack                                $requestStack
     * @param \Rz\UserSecurityBundle\Component\Authentication\Tracker\LoginFailureTracker $loginFailureTracker
     * @param array                                                                         $routeLogin
     * @param array                                                                         $forceAccountRecovery
     * @param array                                                                         $blockPages
     */
    public function __construct(RequestStack $requestStack, LoginFailureTracker $loginFailureTracker, $routeLogin, $forceAccountRecovery, $blockPages);

    /**
     * @access public
     * @return int
     */
    public function vote();
}
