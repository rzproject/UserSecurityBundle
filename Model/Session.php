<?php

namespace Rz\UserSecurityBundle\Model;

class Session implements SessionInterface
{
    /**
     *
     * @var string $ipAddress
     */
    protected $ipAddress;

    /**
     *
     * @var \Datetime $loginAttemptDate
     */
    protected $loginAttemptDate;

    /**
     *
     * @var string $loginAttemptUsername
     */
    protected $loginAttemptUsername;

    /**
     * Set ipAddress
     *
     * @param  string                                  $ipAddress
     * @return \Rz\UserSecurityBundle\Entity\Session
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set loginAttemptDate
     *
     * @param  integer                                 $loginAttemptDate
     * @return \Rz\UserSecurityBundle\Entity\Session
     */
    public function setLoginAttemptDate($loginAttemptDate)
    {
        $this->loginAttemptDate = $loginAttemptDate;

        return $this;
    }

    /**
     * Get loginAttemptDate
     *
     * @return integer
     */
    public function getLoginAttemptDate()
    {
        return $this->loginAttemptDate;
    }

    /**
     * Set loginUsername
     *
     * @param  string                                  $loginUsername
     * @return \Rz\UserSecurityBundle\Entity\Session
     */
    public function setLoginAttemptUsername($loginAttemptUsername)
    {
        $this->loginAttemptUsername = $loginAttemptUsername;

        return $this;
    }

    /**
     * Get loginUsername
     *
     * @return string
     */
    public function getLoginAttemptUsername()
    {
        return $this->loginAttemptUsername;
    }
}
