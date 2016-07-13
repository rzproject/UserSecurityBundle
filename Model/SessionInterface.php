<?php

namespace Rz\UserSecurityBundle\Model;

interface SessionInterface
{
    /**
     * Set ipAddress
     *
     * @param  string                                  $ipAddress
     * @return \Rz\UserSecurityBundle\Entity\Session
     */
    public function setIpAddress($ipAddress);

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress();

    /**
     * Set loginAttemptDate
     *
     * @param  integer                                 $loginAttemptDate
     * @return \Rz\UserSecurityBundle\Entity\Session
     */
    public function setLoginAttemptDate($loginAttemptDate);

    /**
     * Get loginAttemptDate
     *
     * @return integer
     */
    public function getLoginAttemptDate();

    /**
     * Set loginUsername
     *
     * @param  string                                  $loginUsername
     * @return \Rz\UserSecurityBundle\Entity\Session
     */
    public function setLoginAttemptUsername($loginAttemptUsername);

    /**
     * Get loginUsername
     *
     * @return string
     */
    public function getLoginAttemptUsername();
}
