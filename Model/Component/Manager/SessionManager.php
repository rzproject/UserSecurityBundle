<?php

namespace Rz\UserSecurityBundle\Model\Component\Manager;

use Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface;
use Rz\UserSecurityBundle\Model\Component\Manager\BaseManager;

class SessionManager extends BaseManager implements ManagerInterface
{
    /**
     *
     * @access public
     * @param  string                                                          $ipAddress
     * @param  string                                                          $username
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\SessionManager
     */
    public function newRecord($ipAddress, $username)
    {
        $session = $this->create();

        $session->setIpAddress($ipAddress);
        $session->setLoginAttemptUsername($username);
        $session->setLoginAttemptDate(new \DateTime('now'));

        $this
            ->persist($session)
            ->flush()
        ;

        return $this;
    }
}
