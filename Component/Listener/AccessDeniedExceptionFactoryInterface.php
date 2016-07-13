<?php

namespace Rz\UserSecurityBundle\Component\Listener;

interface AccessDeniedExceptionFactoryInterface
{
    /**
     * Create exception thrown when a ip is blocked
     *
     * @return \Exception
     */
    public function createAccessDeniedException();
}
