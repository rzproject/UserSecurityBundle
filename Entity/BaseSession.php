<?php

namespace Rz\UserSecurityBundle\Entity;

use Rz\UserSecurityBundle\Model\Session;

class BaseSession extends Session
{

    protected $createdAt;
    protected $updatedAt;

    /**
     * Pre Persist method
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Pre Update method
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
