<?php

namespace Rz\UserSecurityBundle\Model\FrontModel;

use Rz\UserSecurityBundle\Model\FrontModel\BaseModel;
use Rz\UserSecurityBundle\Model\FrontModel\ModelInterface;

class SessionModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @param  string                                       $ipAddress
     * @param  string                                       $timeLimit
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllByIpAddressAndLoginAttemptDate($ipAddress, $timeLimit)
    {
        return $this->getRepository()->findAllByIpAddressAndLoginAttemptDate($ipAddress, $timeLimit);
    }

    /**
     *
     * @access public
     * @param  string                                                 $ipAddress
     * @param  string                                                 $username
     * @return \Rz\UserSecurityBundle\Model\FrontModel\SessionModel
     */
    public function newRecord($ipAddress, $username)
    {
        return $this->getManager()->newRecord($ipAddress, $username);
    }
}
