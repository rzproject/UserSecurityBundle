<?php

namespace Rz\UserSecurityBundle\Component\Listener;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AccessDeniedExceptionFactory implements AccessDeniedExceptionFactoryInterface
{
    public function createAccessDeniedException()
    {
        return new HttpException(500, 'flood control - login blocked');
    }
}
